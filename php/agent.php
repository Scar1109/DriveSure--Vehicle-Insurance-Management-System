<?php
    //make connection
    require_once 'includes/config.php';
    require_once 'includes/functions.inc.php';
    session_start();

    //delete user policy
    if(isset($_GET["confirm_delete-p"])==false){
        if (isset($_GET["delete-p"])) {
            $ClaimID = $_GET["delete-p"];
            echo '<script>
                if (confirm("Are you sure you want to delete this row?")) {
                    window.location.href = window.location.origin + window.location.pathname + "?confirm_delete-p=true&delete-p=" + ' . $ClaimID . ';
                } else {
                    window.location.href = window.location.origin + window.location.pathname;
                }
            </script>';
        }
    }
    if (isset($_GET["confirm_delete-p"]) && $_GET["confirm_delete-p"] === "true") {
        $ClaimID = $_GET["delete-p"];
        deleteRow($con, 'claimdetails', $ClaimID, 'ClaimID');
        //save activity log
        session_start();
        logActivity($con,$_SESSION["userId"],'Deleted a Claim',$_SESSION["userType"],$_SESSION["userName"]);
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }

    //Approve button function
    if(isset($_GET["confirm_delete-c"])==false){
        if (isset($_GET["delete-c"])) {
            $ClaimID = $_GET["delete-c"];
            echo '<script>
                if (confirm("Are you sure?")) {
                    window.location.href = window.location.origin + window.location.pathname + "?confirm_delete-c=true&delete-c=" + ' . $ClaimID . ';
                } else {
                    window.location.href = window.location.origin + window.location.pathname;
                }
            </script>';
        }
    }
    if (isset($_GET["confirm_delete-c"]) && $_GET["confirm_delete-c"] === "true") {
        $ClaimID = $_GET["delete-c"];
        $sql = "UPDATE claimdetails SET ClaimStatus = 'Approved'  WHERE ClaimID = '$ClaimID'";
        $con->query($sql);
        //save activity log
        logActivity($con,$_SESSION["userId"],'Approved a claim.',$_SESSION["userType"],$_SESSION["userName"]);
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }

    //Checking user type
    if(isset($_SESSION["userType"]) && $_SESSION["userType"] != 'agent'){
        header('location:userAcc.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/agent.styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>

</head>

<?php

// Query to retrieve claim count
$claimCountQuery = "SELECT COUNT(ClaimID) AS claimCount FROM claimdetails";
$claimCountResult = $con->query($claimCountQuery);
$claimCountRow = $claimCountResult->fetch_assoc();
$claimCount = $claimCountRow['claimCount'];

// Query to retrieve inquiry count
$inquiryCountQuery = "SELECT COUNT(inquiryID) AS inquiryCount FROM inquiryform";
$inquiryCountResult = $con->query($inquiryCountQuery);
$inquiryCountRow = $inquiryCountResult->fetch_assoc();
$inquiryCount = $inquiryCountRow['inquiryCount'];

?>

<div class="container">
    <h1>Agent Dashboard</h1>
    <div class="count">
        <div class="claim-count">
            <h3>Total Claims</h3>
            <p><?php echo $claimCount; ?></p>
        </div>
        <div class="inquiry-count">
            <h3>Total Inquiries</h3>
            <p><?php echo $inquiryCount; ?></p>
        </div>
    </div>
    <div class="logOut">
            <button ><a href="includes/logout.inc.php">Log out</a></button>
        </div>
	<br/>

    <?php
    // Query to retrieve data from multiple tables
    $query = "SELECT cd.ClaimID, cd.SubmittedDate, vd.RegistrationNumber, vd.Model, vd.YearOfManufacture, vd.ChassisNo, vd.EngineCapacity, ad.AccidentDate, ad.AccidentTime, ad.Location, vd.VehicleBook, vd.RevenueLicense, vd.VehicleBook
    FROM ClaimDetails cd, VehicleDetails vd, AccidentDetails ad
    WHERE cd.VehicleID = vd.VehicleID
    AND cd.ClaimID = ad.ClaimID";

    $result = $con->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Claim and Accident Details</h2>";
        echo "<table>
                <tr>
                    <th> Claim ID </th>
                    <th> Submitted Date </th>
                    <th> Registration Number </th>
                    <th> Model </th>
                    <th> Year of Manufacture </th>
                    <th> Chassis No </th>
                    <th> Engine Capacity </th>
                    <th> Accident Date </th>
                    <th> Accident Time </th>
                    <th> Location </th>
                    <th> Vehicle Book </th>
                    <th> Revenue License </th>
                    <th> Vehicle Book </th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ClaimID"] . "</td>
                    <td>" . $row["SubmittedDate"] . "</td>
                    <td>" . $row["RegistrationNumber"] . "</td>
                    <td>" . $row["Model"] . "</td>
                    <td>" . $row["YearOfManufacture"] . "</td>
                    <td>" . $row["ChassisNo"] . "</td>
                    <td>" . $row["EngineCapacity"] . "</td>
                    <td>" . $row["AccidentDate"] . "</td>
                    <td>" . $row["AccidentTime"] . "</td>
                    <td>" . $row["Location"] . "</td>
                    <td><a href='" . $row["VehicleBook"] . "' download>Download</a></td>
                    <td><a href='" . $row["RevenueLicense"] . "' download>Download</a></td>
                    <td><a href='" . $row["VehicleBook"] . "' download>Download</a></td>
                    <td>
                        <button style='background-color: red; color: white;'> <a href='?delete-p=" . $row['ClaimID'] . "' class = 'delete-btn'>Delete</a> </button><br/><br/>
                        <button style='background-color: blue; color: white;'> <a href='?delete-c=" . $row['ClaimID'] . "' class = 'approve-btn' style = 'color:white'>Approve</a> </button>
                        <input type='checkbox' name='approveCheckbox[]'>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No claim details found.";
    }

    // Close the database connection
    $con->close();
    ?>

</div>

</body>
</html>