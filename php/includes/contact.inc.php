<?php
require_once 'config.php';

// Retrieve the form data
$name = $_POST["name"];
$email = $_POST["email"];
$mobilenum = $_POST["mobilenum"];
$message = $_POST["message"];


// Prepare the SQL statement
$sql = "INSERT INTO inquiryform (name, email, mobilenum, message) VALUES ('$name', '$email', '$mobilenum', '$message')";

// Execute the SQL statement
if ($con->query($sql) === TRUE) {

    // Close the database connection
    $con->close();

    header('location:../contact.php?error=No-error');
    exit();
} else {

    // Close the database connection
    $con->close();

    header('location:../contact.php?error=DatabaseError');
    exit();
}

?>