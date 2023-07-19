<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/claimForm.styles.css">
    
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
    ?>

<center>
    <div class="container">
        <form action="includes/claimForm.inc.php" method="post" id="claim-form" enctype="multipart/form-data">
            <h2>Claim Information</h2>

            <label for="full-name">Full Name:</label>
            <input type="text" id="full-name" class="form-input" required>

            <label for="email">Email Address:</label>
            <input type="email" pattern="{0-9}{10}" id="email" class="form-input" required>

            <label for="contact-number">Contact Number:</label>
            <input type="tel" id="contact-number" class="form-input" required>

            <h2>Incident Details</h2>

            <label for="vehicle-number">Vehicle Number:</label>
            <input type="text" name="vehicle-number" placeholder="ABC-6458" class="form-input" required>

            <label for="incident-type">Type of Incident:</label>
            <select name="IncidentType" id="incident-type" class="form-input" required>
            <option value="">Select Type</option>
            <option value="accident">Accident</option>
            <option value="theft">Theft</option>
            <option value="vandalism">Vandalism</option>
            <option value="other">Other</option>
            </select>

            <label for="incident-date">Date of Incident:</label>
            <input name="AccidentDate" type="date" id="incident-date" class="form-input" required>

            <label for="incident-time">Time of Incident</label>
            <input name="AccidentTime" type="time" id="incident-time" class="form-input" required>

            <label for="incident-location">Location of Incident:</label>
            <input name="Location" type="text" id="incident-location" class="form-input" required>

            <label for="incident-description">Description of Incident:</label>
            <textarea name="Description" id="incident-description" rows="4" class="form-input" required></textarea>

            <label for="incident-images">Images of Incident:</label>
            <input name="AccidentImages" type="file" class="custom-file-upload" accept="images/*" multiple required>


            <label for="police-reports">Images of Police Reports:</label>
            <input name="PoliceReport" type="file" class="custom-file-upload" accept="images/*" multiple required>

            <br /><br />
            <div class="buttons">
                <input type="submit" value="Submit Claim" name="submit">
            </div>
        </form>
    </div>
</center>
<?php
    if(isset($_GET['message']) || isset($_GET["error"])){
        if($_GET['message']=='success'){
            echo'<script>alert("Your Claim Submission is Successful");</script>';
        }
        elseif($_GET["error"]=='DatabaseError'){
            echo '<script>alert("Error connecting database. Please try again.");</script>';
        }
        elseif($_GET["error"]=='WrongVehicleNo'){
            echo '<script>alert("Wrong vehicle number. Please try again.");</script>';
        }
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }

    include_once 'footer.php';
?>
</body>
</html>