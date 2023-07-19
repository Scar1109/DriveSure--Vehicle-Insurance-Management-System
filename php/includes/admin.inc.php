<?php 
    session_start();
    if(isset($_SESSION["userType"]) != 'admin'){
                header('location:userAcc.php');
                exit();
            }
    require_once 'includes/functions.inc.php';
    require_once 'includes/config.php';
    // Log a activity
    // logActivity($con,$_SESSION["userId"],'Accessed the admin dashboard',$_SESSION["userType"],$_SESSION["userName"]);
    
    //User count from users table
    $sql = 'SELECT COUNT(*) AS row_count FROM users';
    $stmt = $con->query($sql);
    $result = $stmt -> fetch_assoc();
    $userCount = $result["row_count"];
    $stmt -> close();

    //Activity count from activity table
    $sql = 'SELECT COUNT(*) AS row_count FROM activitylogs';
    $stmt = $con->query($sql);
    $result = $stmt -> fetch_assoc();
    $activityCount = $result["row_count"];
    $stmt -> close();

    //Vehicle count from vehicle table
    $sql = 'SELECT COUNT(*) AS row_count FROM vehicledetails';
    $stmt = $con->query($sql);
    $result = $stmt -> fetch_assoc();
    $vehicleCount = $result["row_count"];
    $stmt -> close();

    //Getting activity logs
    $sql = "SELECT UserName, Log, Date, Time, UserType FROM activitylogs";
    $ActivityLogResult = $con->query($sql);

    //Getting user table details
    $sql = "SELECT UserName, UserID, FirstName, Email, RegistrationDate, RegistrationTime, UserType FROM users";
    $UsersResult = $con->query($sql);
?>