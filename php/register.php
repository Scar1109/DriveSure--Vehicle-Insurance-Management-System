<?php
// Retrieve the query parameter 'topic'
$topic = $_GET['topic'];

// Determine the content based on the 'topic' value
if ($topic === 'car') {
    $content = 'Insure your car';
} elseif ($topic === 'motorcycle') {
    $content = 'Insure your motorcycle';
} elseif ($topic === 'three-wheeler') {
    $content = 'Insure your three-wheeler';
}elseif($topic === 'commercial-vehicle'){
    $content = 'Insure your commercial vehicle';
}else{
    $content = 'none';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/register.styles.css">
    
    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>

</head>
<body>
    <?php
        include_once 'header.php';
        if(isset($_SESSION["userName"]) == false){
            header('location:login.php?error=pleaseLogin-vehicle');
            exit();
        }
    ?>  
    <div class="vehicle-form">
        <form method="POST" action="includes/register.inc.php" enctype="multipart/form-data">
            <input type="hidden" name="vehicleType" value="<?php echo htmlspecialchars($topic); ?>">
                <div class="f1">
                <h3><?php echo $content; ?></h3>
                    <hr><br>

                    <label for="Uname">Vehicle Registration Number </label>
                    <input type="text" id="VRN" name="regNum" placeholder="ABC - 6458"required><br><br>
                
                    <label for="Model">Model</label>
                    <input type="text" id="Model" name="Model"placeholder="Toyota  /  Yamaha  /  Bajaj  /  Tata"required><br><br>
                
                    <label for="Year">Year of Manufacture</label>
                    <input type="text" id="Year" name="YOM"placeholder="Year"required><br><br>
                
                    <label for="Type">Body Type </label>
                    <input type="text" id="Type" name="bodyType"placeholder="Hatchback  /  Standard  /  Bajaj RE  /  Flat Beds"required><br><br>
                
                    <label for="Chassis">Chassis Number </label>
                    <input type="text" id="Chassis" name="ChassisNumber" placeholder="Chassis Number"required><br><br>
                
                    <label for="Capacity">Engine Capacity </label>
                    <input type="number" id="Capacity" name="EngineCapacity" placeholder="200  /  500  /  1000  /  1500  /  1800  /  2500"required><br><br>
                
                    <label for="Milage">Milage</label>
                    <input type="number" id="Milage" name="Milage"placeholder="Milage"required><br><br>

                    <label for="Coverage">Coverage</label>
                    <select name="coverage" id="Coverage">
                        <option value="">Select Coverage</option>
                        <option value="Full Option">Full Option</option>
                        <option value="Third Party">Third Party</option>
                    </select>
                    <br><br>

                    <label for="Duration">Time Duration</label>
                    <select name="time_duration" id="Duration">
                        <option value="">Select Duration</option>
                        <option value="Six Months">6 Months</option>
                        <option value="One Year">1 Year</option>
                    </select><br>
                </div>

                <div class="f2">

                    <h3>Upload Documents</h3>
                    <hr>
                    <label for="Vehicle Book">Vehicle Book</label>
                    <input type="file" id="Vehicle Book" name="vehical_book_src"class="file-upload">
                    <br><br>
                    <label for="Revenue Liscence">Revenue Liscence</label>
                    <input type="file" id="Revenue Liscence" name="revenue_liscence_src"class="file-upload">
                    <br><br>
                    <label for="NIC Photo">NIC Photo</label>
                    <input type="file" id="NIC Photo" name="nic_src"class="file-upload">
                    <br><br>
                </div>
                <br>
                <button type="reset" class="btn_1">Clear Form</button>
                <button type="submit" class="btn_2" name="save_details">Get a Quote</button>
        </form>
    </div>
<br><br><br>
    <?php
        include_once 'footer.php';
    ?>
</body>
</html>