<?php
    if (isset($_POST['submit'])) {

        $IncidentType=$_POST['IncidentType'];
        $AccidentDate = $_POST['AccidentDate'];
        $AccidentTime = $_POST['AccidentTime'];
        $Location = $_POST['Location'];
        $Description = $_POST['Description'];
        $VehicleNo = $_POST['vehicle-number'];

        //stablish connection to database
        require_once 'config.php';
        require_once 'functions.inc.php';

        //Checking vehicle id for vehicle number
        $sql1="SELECT * FROM vehicledetails WHERE RegistrationNumber = '$VehicleNo' ";
        $stmt= mysqli_query($con,$sql1);

        if ($stmt) {
            if (mysqli_num_rows($stmt) > 0) {
                $row = mysqli_fetch_assoc($stmt);
                $vehicleId = $row['VehicleID'];
                $stmt->close();
        
                $sql2 = "INSERT INTO claimdetails (VehicleID) VALUES ('$vehicleId');";
                $stmt = mysqli_query($con, $sql2);
                if ($stmt) {
                    $claimID = mysqli_insert_id($con);
                }
            } else {
                header('location:../claimForm.php?error=WrongVehicleNo');
                exit();
            }
        } else {
            header('location:../claimForm.php?error=DatabaseError');
        }

        $AccidentImages=$_FILES['AccidentImages'];
        $PoliceReport=$_FILES['PoliceReport'];

        $AccidentImagesName=$AccidentImages['name'];
        $AccidentImagesFileType=$AccidentImages['type'];
        $AccidentImagesSize=$AccidentImages['size'];
        $AccidentImagesTmpPath=$AccidentImages['tmp_name'];

        $PoliceReportName=$PoliceReport['name'];
        $PoliceReportFileType=$PoliceReport['type'];
        $PoliceReportSize=$PoliceReport['size'];
        $PoliceReportTmpPath=$PoliceReport['tmp_name'];

        //generating unique name for files
        $AccidentImagesNewName= generateUniqueFileName($AccidentImagesName,$claimID,'accident_img');
        $PoliceReportNameNewName= generateUniqueFileName($PoliceReportName,$claimID,'police_report');

        $AccidentImagesDestination = "../../uploads/AccidentImages/" . $AccidentImagesNewName;
        move_uploaded_file($AccidentImagesTmpPath,$AccidentImagesDestination);

        $PoliceReportDestination = "../../uploads/PoliceReport/" . $PoliceReportNameNewName;
        move_uploaded_file($PoliceReportTmpPath,$PoliceReportDestination);

        

        $sql = "insert into accidentdetails(AccidentDate,AccidentTime,Location,Description,IncidentType,AccidentImages,PoliceReport,ClaimID)
        values('$AccidentDate','$AccidentTime','$Location','$Description','$IncidentType','$AccidentImagesNewName','$PoliceReportNameNewName','$claimID');";

        //inserting data
        $result = mysqli_query($con, $sql);
        if ($result) {

            //save activity log
            session_start();
            logActivity($con,$_SESSION["userId"],'Submitted a Claim',$_SESSION["userType"],$_SESSION["userName"]);

            header('location:../claimForm.php?message=success');
            $con -> close();
            exit();
        } else {
            header('location:../claimForm.php?error=DatabaseError');
            $con -> close();
            exit();
        }

    }

    else{
        header('location:../claimForm.php');
        exit();
    }

?>