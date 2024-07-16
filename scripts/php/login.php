<?php
session_start();

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
    // Check if email and password are provided
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize inputs to prevent SQL injection
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $_SESSION["username"]= $email;
        // Perform SQL query to check credentials
        $sql = "SELECT * FROM login WHERE email='$email' AND passwd='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0 && $email != 'admin@grepMny.com') {
            // Redirect to another page on successful login
            header("Location: ../../src/grepMny.html");
            exit();
        }elseif($email=='admin@grepMny.com' && $password=='111'){
            header("Location: http://localhost/phpmyadmin/index.php?route=/sql&db=test&table=login&pos=0");
            exit();
        }
        else 
        {
            // If login fails, you can display an error message or perform other actions
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Email and password are required.";
    }
}

// Close connection
$conn->close();
?>
