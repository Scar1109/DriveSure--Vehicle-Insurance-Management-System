<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/renew.styles.css">
    <script src="../js/renewcalc.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>
</head>
<body>
    <?php
        include_once 'includes/config.php';
        include_once 'header.php';
        if(isset($_SESSION["userName"]) == false){
            header('location:login.php?error=pleaseLogin-claim');
            exit();
        }
    ?>

<section class="renewpolicysec">
    <div class="renewpolicy" style="color: rgb(243, 243, 243); font-size: 50px; text-align: center;">
        <h3>RENEW POLICY</h3>
    </div>
</section>

<section style="height:65vh; background-color:rgb(197, 222, 232);">
<div style="background-color:rgb(197, 222, 232);">
    <div style="float:right">
        <video autoplay loop muted src="../images/Auto Insurance Animated Video.mp4" width="785" height="auto" style="top:5%; margin-top:12px; margin-right:12px;"></video>
</div>

        <div class="thirdparty" style="background-color:rgb(197, 222, 232); float:left; width:46%; padding-left:10px;">
        <h4>Third Party</h4>
        <p>A third-party car insurance is the most common type of vehicle insurance.</br>
            It covers only the damages &amp; losses caused to a third-party vehicle,</br>
            property or person in the event of an accident.</P>
        </div>
        
        
        <div class="make" style="background-color:rgb(197, 222, 232); float:left; width:46%; padding-left:10px;">
        <h4>Make Your Own</h4>
        <p>
        Fairfirst Insurance's unique à la carte policy allows you to cover selected</br>
            parts of your vehicle only. Pick and pay for only the parts which you'd like to cover!
        </P>
        </div> 
        
        <div class="full" style="background-color:rgb(197, 222, 232); float:left; width:46%; padding-left:10px;">
        <h4>Full Option</h4>
        <p>
        In case you meet with an accident where the repair cost of your vehicle exceeds </br>
        its insured value, you will receive the total insured value of your vehicle as your claim.</P>
        </div> 
        </div>
    </section>

    <hr style="color:rgb(51, 17, 17)">

    <section id="sec2" style="background-color: #149ad5;">
    <div class="currentdis">
        <div class="policyId">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span>INPUT YOUR POLICY ID :</span>
                <input type="" name="policyId"></input>
                <input type="submit" name="submit" value="Search"></input><br><br>
            </form>
        </div>

    <div class="table1" >

    <?php
    //Retrieve data for policy id
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $PolicyID = $_POST['policyId'];
    $sql = "SELECT * FROM policydetails WHERE PolicyID = '$PolicyID'";
    $result = $con -> query($sql);
    if($result->num_rows > 0){
    $policyDetails = $result -> fetch_assoc();
    //Exp date calc
    if($policyDetails['TimeDuration'] == 'One Year'){
        $expDate = date('Y-m-d', strtotime($policyDetails['RegisterDate'] . ' +1 year'));
    }
    elseif($policyDetails['TimeDuration'] == 'Six Months'){
        $expDate = date('Y-m-d', strtotime($policyDetails['RegisterDate'] . ' +6 months'));
    }
    else{
        $expDate = 0;
    }
    ?>
    <table class="tb">
            <tr>
                <th> PolicyID :</th>
                <td><?php echo $PolicyID; ?></td>
            </tr>
            <tr>
                <th>Vehicle ID :</th>
                <td><?php echo $policyDetails['VehicleID']; ?></td>
            </tr>
            <tr>
                <th> Coverage :</th>
                <td> <?php echo $policyDetails['Coverage']; ?></td>
            </tr>
            <tr>
                <th> Expire Date :</th>
                <td> <?php echo $expDate; ?></td>
            </tr>
    </table>
    </div>
    </section>

    <section style="background-color: rgb(99, 99, 101); padding: 5px 30px; margin-top: 10px; color:aliceblue" >
        <div >
            <p style="margin-left:40%"><h2 > Do you want to renew your Current insurance? </br>
            Now You Can Renew Your policy Easily </h2> 
            </p>    
        </div>
    </section>

    <section>
        <div>
            <form action="includes/renew.inc.php" border="1" method="POST" >
                <div class="policy">
                    Your Policy ID: <input type="text" name="policyId" value="<?php echo $PolicyID; ?>" readonly> </input></br></br>
                    Select Your Package:   
                    <select name="coverage" onchange="calculateTotalAmount()">
                        <option value="Third Party">Third Party</option>
                        <option value="Make_Your_Own">Make Your Own</option>
                        <option value="Full Option">Full Option</option>
                    </select>
                    </br></br>
                    select duration: 
                    <select name="months" onchange="calculateTotalAmount()">
                        <option value="6_MONTHS">6 MONTHS</option>
                        <option value="12_MONTHS">12 MONTHS</option>
                    </select>
                    </br></br> 
                    Vehicle ID:
                    <input type="text" name="vehicleID" value="<?php echo $policyDetails['VehicleID']; ?>" readonly></input><br></br>
                    <input type="hidden" name="payAmount" id="myInput" value="">
                </div>  
        </div>	
    </section>
    <hr>

    <section>
    <div class="payment" style="height:18vh ; background-color: rgb(99, 99, 101); color: aliceblue;" >
    <p style="float:left">
        Your Total Amount Is : <span id="totalAmountDisplay"></span></br>
    </p>
    <p style="float:right"> Click Here To Pay</br> <input type='submit' name='submit' value='Pay Now'></input> </p>   
    </div>
    </section>

    </form>

    <?php }
    else{
        echo"<span >No Data found for that policy ID</span><br><br>";
    }} ?>
    </div></div>
    <?php
        include_once 'footer.php';
    ?>
</body>
</html>