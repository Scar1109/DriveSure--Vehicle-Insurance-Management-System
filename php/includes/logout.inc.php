<?php
    session_start();

    //Add logs to activity log
    require_once 'config.php';
    require_once 'functions.inc.php';
    logActivity($con,$_SESSION["userId"],'Loges out from the system',$_SESSION["userType"],$_SESSION["userName"]);
    $con->close();

    session_unset();
    session_destroy();
    header('location:../index.php');
    exit();