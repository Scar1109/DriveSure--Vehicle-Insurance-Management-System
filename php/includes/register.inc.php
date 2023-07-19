<?php

if(isset($_POST["save_details"])) {
        $vehicleType = $_POST["vehicleType"];
        $registrationNum = $_POST["regNum"];
        $model = $_POST["Model"];
        $YOM = $_POST["YOM"];
        $bodyType = $_POST["bodyType"];
        $chassis_number = $_POST['ChassisNumber'];
        $engine_capacity = $_POST['EngineCapacity'];
        $milage = $_POST['Milage'];
        $coverage = $_POST['coverage'];
        $time_duration = $_POST['time_duration'];

        $vehical_book_src = $_FILES['vehical_book_src'];
        $revenue_liscence_src = $_FILES['revenue_liscence_src'];
        $nic_src = $_FILES['nic_src'];

        require_once 'config.php';
        require_once 'functions.inc.php';

        //getting file details
        $vehicleBookName = $vehical_book_src['name'];
        $vehicleBookFileType = $vehical_book_src['type'];
        $vehicleBookTempPath = $vehical_book_src['tmp_name'];

        $revenueLiscenceName = $revenue_liscence_src['name'];
        $revenueLiscenceType = $revenue_liscence_src['type'];
        $revenueLiscenceTempPath = $revenue_liscence_src['tmp_name'];

        $nicName = $nic_src['name'];
        $nicFileType = $nic_src['type'];
        $nicTempPath = $nic_src['tmp_name'];

        //generating unique name for files
        $vehicleBookNewName = generateUniqueFileName($vehicleBookName,$registrationNum,'vehicle_book');
        $revenueLiscenceNewName = generateUniqueFileName($revenueLiscenceName,$registrationNum,'revenue_license');
        $nicNewName = generateUniqueFileName($nicName,$registrationNum,'nic');

        //moving to new destination
        $vehicleBookDestination = "../../uploads/vehicleBook/".$vehicleBookNewName;
        move_uploaded_file($vehicleBookTempPath, $vehicleBookDestination);
        $revenueLiscenceDestination = "../../uploads/revenue_license/".$revenueLiscenceNewName;
        move_uploaded_file($revenueLiscenceTempPath, $revenueLiscenceDestination);
        $nicDestination = "../../uploads/NIC/".$nicNewName;
        move_uploaded_file($nicTempPath, $nicDestination);

        $sql1 =  "INSERT INTO vehicledetails (RegistrationNumber,vehicleType,Model,YearOfManufacture,BodyType,EngineCapacity,ChassisNo,Milage,UserID,VehicleBook,RevenueLicense,NIC) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt1 = $con-> prepare($sql1);
        session_start();

        //save activity log
        logActivity($con,$_SESSION["userId"],'Registered a vehicle',$_SESSION["userType"],$_SESSION["userName"]);

        $userID = $_SESSION["userId"];
        $stmt1->bind_param("ssssssssssss", $registrationNum, $vehicleType, $model, $YOM, $bodyType, $engine_capacity, $chassis_number, $milage, $userID, $vehicleBookNewName, $revenueLiscenceNewName, $nicNewName);


        if($stmt1->execute()){
            $vehicleId = $stmt1->insert_id;
            $stmt1 -> close();

            $sql2 = "INSERT INTO policydetails(Coverage,TimeDuration,VehicleID) VALUES (?,?,?);";

            $stmt2 = $con->prepare($sql2);
            $stmt2->bind_param("sss", $coverage, $time_duration, $vehicleId);

            if($stmt2 -> execute()){
                $stmt2->close();
                $con ->close();
                header('location:../index.php?message=policy-success');
                exit();
            }
            else{
                header('location:../register.php?error=DatabaseError1');
                $con -> close();
                exit();
            }
        }
        else{
            header('location:../register.php?error=DatabaseError2');
            $con -> close();
            exit();
        }

}