<?php
require 'config.php';

if(isset($_POST["submit"])){
  $policyID = $_POST['policyId'];
  $coverage = $_POST['coverage'];
  $months = $_POST['months'];
  $vehicleID = $_POST['vehicleID'];
  $amount = $_POST["payAmount"];

  $sql = "INSERT INTO policydetails (Coverage, TimeDuration, VehicleID) VALUES ('$coverage', '$months', '$vehicleID')";

  // Execute the SQL query
  if($con->query($sql)){
    session_start();
    $_SESSION["policyID"]=$policyID;
    $_SESSION["amount"]=$amount;
    header('location:../payment.php');
    exit();
  } else{
    header('location:../renew.php?error=databaseError');
    exit();
  }
}
?>
