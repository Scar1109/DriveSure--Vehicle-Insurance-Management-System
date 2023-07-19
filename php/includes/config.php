<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "drivesure";

// Create connection
$con = new mysqli($serverName, $username, $password, $dbName);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}