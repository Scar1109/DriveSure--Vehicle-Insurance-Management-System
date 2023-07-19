<?php
    session_start();

    require_once 'config.php';
    require_once 'functions.inc.php';
    //Add logs to activity
    logActivity($con,$_SESSION["userId"],'User deletes his account',$_SESSION["userType"],$_SESSION["userName"]);
    //delete user
    deleteRow($con,'users',$_SESSION["userId"],'UserID');

    session_unset();
    session_destroy();
    header('location:../index.php');
    exit();