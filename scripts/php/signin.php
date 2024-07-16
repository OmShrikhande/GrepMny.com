<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "grepMny"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and passwords are provided
    if (isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['userid'])) {
        // Sanitize inputs to prevent SQL injection
        $email = $conn->real_escape_string($_POST['email']);
        $password1 = $conn->real_escape_string($_POST['password1']);
        $password2 = $conn->real_escape_string($_POST['password2']);
        $userid = $conn->real_escape_string($_POST['userid']);
        

        // Check if email is not null
        if (!empty($email)) {
            // Check if passwords match
            if ($password1 == $password2) {
                // SQL query to insert data
                $sql = "INSERT INTO `login` (`email`, `passwd`,`userid`) VALUES ('$email', '$password2','$userid');";
                $sqluser ="SELECT  userid from login where userid = '$userid'";
                $temp =$conn->query($sqluser);

                 
                // Execute SQL query
                if($temp->num_rows == 0){

                if ($conn->query($sql) === TRUE) {
                    // Redirect to another page on successful registration
                    echo "Registered Successfully";
                    header("Location: ../../index.html");
                    exit; // Terminate script after redirection
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

            }
            else{
                echo "Try another user id ";
            }
            } else {
                echo "Passwords do not match";
            }

        
        } else {
            echo "Email cannot be empty";
        }
    } else {
        echo "Email and passwords are required.";
    }
}

// Close connection
$conn->close();
?>
