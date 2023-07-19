<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/userAcc.styles.css">

    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>
</head>

<body>
    <?php
    include_once 'header.php';
    if(isset($_SESSION["userName"]) == false){
        header('location:login.php?error=pleaseLogin-claim');
        exit();
    }

    require_once 'includes/config.php';
    ?>

    <!-- profile picture -->
    <div class="pic">
        <i class="fa fa-user-circle-o" style="font-size:150px" ;></i>
    </div>

    <!-- Button for accessing admin portal -->
    <?php if ($_SESSION["userType"] == "admin") { ?>
        <button style="float: right;" onclick="location.href = 'admin.php';" class="button">Admin Portal</button>
    <?php } ?>

    <!-- Button for accessing agent portal -->
    <?php if ($_SESSION["userType"] == "agent") { ?>
        <button style="float: right;" onclick="location.href = 'agent.php';" class="button">Agent Portal</button>
    <?php } ?>

    <!-- Button for delete user -->
    <?php if ($_SESSION["userType"] == "user") { ?>
        <button style="float: right;" onclick="location.href = 'includes/deleteUser.inc.php';" class="button">Delete my account</button>
    <?php } ?>

    <!-- Fetching user data-->
    <?php
    $userID = $_SESSION["userId"];
    $sql1 = "SELECT * FROM users WHERE UserID = $userID;";
    $res1 = $con->query($sql1);
    $user = $res1->fetch_assoc();
    ?>

    <!-- User Details -->
    <div class="div1">
        <table class="tb">
            <tr>
                <th colspan="2"class="heading">User Details:</th>
            </tr>
            <tr>
                <th> Name</th>
                <td><?php echo $user['FirstName']; ?></td>
            </tr>
            <tr>
                <th> User Name</th>
                <td><?php echo $user['UserName']; ?></td>
            </tr>
            <tr>
                <th> Email</th>
                <td> <?php echo $user['Email']; ?></td>
            </tr>
            <tr>
                <th> Gender</th>
                <td> <?php echo $user['Gender']; ?></td>
            </tr>
            <tr>
                <th> DOB</th>
                <td> <?php echo $user['DOB']; ?> </td>
            </tr>
            <tr>
                <th> Phone Number</th>
                <td><?php echo $user['ContactNo']; ?> </td>
            </tr>
            <tr>
                <th> NIC</th>
                <td> <?php echo $user['NIC']; ?></td>
            </tr>
            <tr>
                <th> Address</th>
                <td> <?php echo $user['Address']; ?></td>
            </tr>
        </table>
    </div>

<!-- Fetching vehicle details -->
<?php
$sql2 = "SELECT * FROM vehicledetails WHERE UserID = $userID;";
$res2 = $con->query($sql2);
?>

<?php
// check if there are any vehicles registered
if ($res2->num_rows > 0) {
    // Vehicle Details
    
    while ($vehicle = $res2->fetch_assoc()){
        echo '<div class="div1">';
    ?>
    <table class="tb">
        <tr>
            <th colspan="2" class="heading">Vehicle Details:</th>
        </tr>
        <tr>
            <th>Registration Number</th>
            <td><?php echo $vehicle['RegistrationNumber']; ?></td>
        </tr>
        <tr>
            <th>Chassis Number</th>
            <td><?php echo $vehicle['ChassisNo']; ?></td>
        </tr>
        <tr>
            <th>Year Of Manufacture</th>
            <td><?php echo $vehicle['YearOfManufacture']; ?></td>
        </tr>
        <tr>
            <th>Vehicle Model</th>
            <td><?php echo $vehicle['Model']; ?></td>
        </tr>
    </table>
    <?php

    // Fetching Policy Details
    $vehicleID = $vehicle["VehicleID"];
    $sql = "SELECT * FROM policydetails WHERE VehicleID = $vehicleID;";
    $policies = $con->query($sql);

    // Check if there are any policies created
    if ($policies->num_rows > 0) {
        // Policy Details
        echo '<div ><table class="tb">
        <tr>
            <th colspan="2" class="heading">Policy Details:</th>
        </tr>';
        while ($policy = $policies->fetch_assoc()) {
            //Exp date calc
            if($policy['TimeDuration'] == 'One Year'){
                $expDate = date('Y-m-d', strtotime($policy['RegisterDate'] . ' +1 year'));
            }
            elseif($policy['TimeDuration'] == 'Six Months'){
                $expDate = date('Y-m-d', strtotime($policy['RegisterDate'] . ' +6 months'));
            }
            ?>
            
                <tr>
                    <th>Policy ID</th>
                    <td><?php echo $policy['PolicyID']; ?></td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td><?php echo $policy['RegisterDate']; ?></td>
                </tr>
                <tr>
                    <th>Coverage</th>
                    <td><?php echo $policy['Coverage']; ?></td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td><?php echo $policy['TimeDuration']; ?></td>
                </tr>
                <tr>
                    <th>Expire Date</th>
                    <td><?php echo $expDate; ?></td>
                </tr>
                <!-- Add hr tag here -->
                <tr>
                <td colspan="2"><hr class="hrr"></td>  
                </tr>
            <?php
        }
        echo '</table></div>';
    } else {
        // No Policy
        echo '<span class="message">No policy created.</span>';
    }

    // Fetching claim details
    $sql = "SELECT * FROM claimdetails WHERE VehicleID = $vehicleID;";
    $claims = $con->query($sql);

    // Check if there are any claims filed
    if ($claims->num_rows > 0) {
        // Claim Details
        echo '<div >';
            ?>
            <table class="tb">
                <tr>
                    <th colspan="2" class="heading">Claim Details:</th>
                </tr>
            <?php while ($claimDetails = $claims->fetch_assoc()) { 
                ?>
                <tr>
                    <th>Claim Number</th>
                    <td><?php echo $claimDetails['ClaimID']; ?></td>
                </tr>
                <tr>
                    <th>Claim Status</th>
                    <td><?php echo $claimDetails['ClaimStatus']; ?></td>
                </tr>
                <tr>
                    <th>Submitted Date</th>
                    <td><?php echo $claimDetails['SubmittedDate']; ?></td>
                </tr>
                <!-- Add hr tag here -->
                <tr>
                <td colspan="2"><hr class="hrr"></td>  
                </tr>
            <?php
        }
        echo '</table>';
        echo '</div></div>';
    } else {
        // No claims filed
        echo '<span class="message">No claims filed.</span>';
    }
    echo "</div>";
}
} else {
    // No vehicles registered
    echo '<span class="message">No vehicles registered.</span>';
}
?>

    <?php
    include_once 'footer.php';
    ?> 
</body>

</html>