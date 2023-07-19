<?php

if (isset($_POST['submit'])) {
    
    $status ='successful';
    

    session_start();

    $userID=$_SESSION['userId'];

    $PolicyID =$_SESSION["policyID"];
    unset($_SESSION['policyID']);

    $Amount = $_SESSION['amount'];
    unset($_SESSION['amount']);


    include 'config.php';

    $sql="insert into payment(Amount,PaymentStatus,UserID,PolicyID)
    values('$Amount','$status','$userID','$PolicyID')";

    $result = mysqli_query($con, $sql);
    if ($result) {
    header('location:../index.php?message=success-payment');
    
    } 

    else{
        die(mysqli_error($con));
    }

}






?>