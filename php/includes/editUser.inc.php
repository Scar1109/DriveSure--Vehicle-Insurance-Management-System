<?php
if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $userType = $_POST["userType"];
    $email = $username;

    require_once 'config.php';
    require_once 'functions.inc.php';


    //Checking email is exist
    $sql = "SELECT * FROM users WHERE Email = ? OR UserName =?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $stmt->close();

        $userID = $row["UserID"];
        //update the database
        $sql = "UPDATE users SET UserType = ? WHERE UserID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $userType, $userID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
        $stmt->close();
            //save activity log
            session_start();
            logActivity($con,$_SESSION["userId"],'Changed a user role',$_SESSION["userType"],$_SESSION["userName"]);

            $con-> close();
            header('location:../admin.php?error=success-edtUsr');
            exit();
        } else {
            header('location:../admin.php?error=DatabaseError');
        exit();
        }
        }
    else{
        $stmt->close();
        $con->close();
        header('location:../admin.php.php?error=UsernameDoesNotExist');
        exit();
    }

}

else{
    header('Location:../admin.php');
    exit();
}