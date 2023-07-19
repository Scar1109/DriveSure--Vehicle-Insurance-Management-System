<?php

    if(isset($_POST["submit"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $usersname = $_POST["userName"];
        $email = $_POST["email"];
        $dob = $_POST["DOB"];
        $mobileNo = $_POST["mobile"];
        $address = $_POST["address"];
        $nic = $_POST["NIC"];
        $gender = $_POST["gender"];
        $pwd = $_POST["pwd"];
        $userType = $_POST["userType"];

        require_once 'config.php';
        require_once 'functions.inc.php';
    
        //create inputs array and error checking functions
        $userExists = userExistsSignup($con, $usersname, $email, $nic);
        
        //check username already exist
        if($userExists !== false){
            header('location:../admin.php?error=userExists');
            exit();
        }

        //save data to database
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);//password hashing
        $sql = "INSERT INTO Users (NIC, FirstName, LastName, Email, ContactNo, UserName, DOB, Password, Address, Gender, UserType)
        VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssssss",$nic,$firstName,$lastName,$email,$mobileNo,$usersname,$dob,$hashedPwd,$address,$gender,$userType);//binding parameters

        if($stmt->execute()){

            //save activity log
            session_start();
            logActivity($con,$_SESSION["userId"],'Added a user',$_SESSION["userType"],$_SESSION["userName"]);

            $con->close();
            $stmt->close();
            header('location:../admin.php?error=noError');//redirect to home page
            exit();
        }
        else{
            $con->close();
            header('location:../admin.php?error=DatabaseError');
            exit();
        }
        
    }
    else{
        header('location:../admin.php');
        exit();
    }
