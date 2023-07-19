<?php
if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $Password = $_POST["Password"];

    require_once 'config.php';
    require_once 'functions.inc.php';

    //creating error checking variables
    $emptyInput = emptyInputLogin($email, $Password);

    //Check empty inputs
    if($emptyInput !== false){
        header('location:../signup.php?error=emptyInputs');
        exit();
    }

    //Checking email is exist
    $sql = "SELECT * FROM Users WHERE Email = ? OR UserName =?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $stmt->close();
        
        //retrieve hashed pwd
        $pwdHashed = $row["Password"];

        //check pwd
        $checkPwd = password_verify($Password, $pwdHashed);

        if($checkPwd === false){
            header('location:../login.php?error=WrongPassword');
        }
        elseif($checkPwd === true){
            session_start();//starting session
            $_SESSION["userName"] = $row["UserName"];
            $_SESSION["firstName"] = $row["FirstName"];
            $_SESSION["userId"] = $row["UserID"];
            $_SESSION["userType"] = $row["UserType"];

            //save activity log
            logActivity($con,$_SESSION["userId"],'Logged into system',$_SESSION["userType"],$_SESSION["userName"]);

            $stmt->close();
            $con->close();
            
            //check user types and redirect to there web pages
            if($_SESSION["userType"] == 'user'){
                header('location:../index.php');
                exit();
            }
            elseif($_SESSION["userType"] == 'admin'){
                header('location:../admin.php');
                exit();
            }
            elseif($_SESSION["userType"] == 'agent'){
                header('location:../agent.php');
                exit();
            }
            else{
                header('location:logout.inc.php');
                exit();
            }
        }

    }
    else{
        $stmt->close();
        $con->close();
        header('location:../login.php?error=UsernameDoesNotExist');
        exit();
    }

}

else{
    header('Location:../login.php');
    exit();
}