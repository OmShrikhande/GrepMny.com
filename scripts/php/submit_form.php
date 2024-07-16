<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grepmny"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO `student details` (sname, semail, cid, cname, duration, start_date, end_date, fees) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissssi", $sname, $semail, $cid, $cname, $duration, $start_date, $end_date, $fees);

// Set parameters and execute
$sname = $_POST['sname'];
$semail = $_POST['semail'];
$cid = $_POST['cid'];
$cname = $_POST['cname'];
$duration = $_POST['duration'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$fees = $_POST['fees'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
