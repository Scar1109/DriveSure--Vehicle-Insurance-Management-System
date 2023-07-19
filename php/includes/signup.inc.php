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
        $repeatPwd = $_POST["repeat-pwd"];

        require_once 'config.php';
        require_once 'functions.inc.php';
    
        //create inputs array and error checking functions
        $inputs = array($firstName, $lastName, $usersname, $email, $dob, $mobileNo, $address, $nic, $gender, $pwd, $repeatPwd);
        $emptyInput = emptyInputSignup($inputs);
        $passwordMatch = passwordMatch($pwd, $repeatPwd);
        $userExists = userExistsSignup($con, $usersname, $email, $nic);
        

        //Check empty inputs
        if($emptyInput !== false){
            header('location:../signup.php?error=emptyInputs');
            exit();
        }

        //check password matching
        if($passwordMatch !== false){
            header('location:../signup.php?error=passwordMissMatch');
            exit();
        }

        //check username already exist
        if($userExists !== false){
            header('location:../signup.php?error=userExists');
            exit();
        }

        //save data to database
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);//password hashing
        $sql = "INSERT INTO Users (NIC, FirstName, LastName, Email, ContactNo, UserName, DOB, Password, Address, Gender)
        VALUES(?,?,?,?,?,?,?,?,?,?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssssss",$nic,$firstName,$lastName,$email,$mobileNo,$usersname,$dob,$hashedPwd,$address,$gender);//binding parameters

        if($stmt->execute()){
            //get user id
            $userID = $stmt->insert_id;

            session_start();//starting session

            $_SESSION["userName"] = $usersname;
            $_SESSION["firstName"] = $firstName;
            $_SESSION["userId"] = $userID;
            $_SESSION["userType"] = 'user';

            //save activity log
            logActivity($con,$_SESSION["userId"],'Create an account',$_SESSION["userType"],$_SESSION["userName"]);

            $con->close();
            $stmt->close();
            header('location:../index.php');//redirect to home page
            exit();
        }
        else{
            $con->close();
            header('location:../signup.php?error=DatabaseError');
            exit();
        }
        
    }
    else{
        header('location:../signup.php');
        exit();
    }
