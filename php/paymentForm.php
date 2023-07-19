<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/paymentForm.styles.css">
    
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



<div class="container">


<!-- center the form  -->
<center> 

<div class="form-div">

<h2>Payment Details</h2>


  <form  action="includes/paymentForm.inc.php" method="post" class="payment-form">


    <label  for="payment-method">Payment Method:</label><br/>
    <div>
      <input class="visa" type="radio" id="visa" name="payment-method" value="Visa Card" required>
      <label class="visa" for="visa">Visa Card</label>
    </div>
    <div>
      <input class="master" type="radio" id="mastercard" name="payment-method" value="Master Card" required>
      <label class="master" for="mastercard">Master Card</label>
    </div>

    <br/><br/><br/>
            
    <label for="cardholder-name">Cardholder's Name:</label>
    <input type="text" id="cardholder-name" name="cardholder-name" required>

    <br/><br/><br/>

    <label for="account-number">Account Number:</label>
    <input type="text" id="account-number" name="account-number" pattern="[0-9]{16}" required>

    <br/><br/><br/>

    <label for="expiry">Expiry:</label><br/>
    <select id="expiry-month" name="expiry-month" required>
      <option value="">Month</option>
      <option value="Jan">Jan</option>
                <option value="Feb">Feb</option>
                <option value="Mar">Mar</option>
                <option value="Apr">Apr</option>
                <option value="May">May</option>
                <option value="Jun">Jun</option>
                <option value="Jul">Jul</option>
                <option value="Aug">Aug</option>
                <option value="Sep">Sep</option>
                <option value="Oct">Oct</option>
                <option value="Nov">Nov</option>
                <option value="Dec">Dec</option>
   
    </select>

    <br/>


    <select id="expiry-year" name="expiry-year" required>
      <option value="">Year</option>
      <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
    </select>

    <br/><br/><br/>

    <label for="cvc">CVC:</label>
    <input type="text" id="cvc" name="cvc" pattern="[0-9]{3}" required>

    <br/><br/><br/>

    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="Amount" value="<?php echo $_SESSION['amount']?>" readonly>


    <div class="buttons">
      <input class="btn" type="submit" id="pay-now-btn" value="Pay Now" name="submit">
    </div>
  </form>
    </div>

</center>

</div>



<?php


    include_once 'footer.php';
    ?>
</body>

</html>