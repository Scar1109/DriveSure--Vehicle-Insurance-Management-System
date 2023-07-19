<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/payment.styles.css">
    
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


    <div class="main-box">



        <div class="image-box">
            <image class="firstPage-image" src="../images/payment-image.jpg" />

            <div class="main-heading">
            <h1>Pay Premium - Vehicle Insurance</h1>

        </div>

            <div class="heading2">Hassle Free Premium Payment</div>

        </div>

    </div>

    <br />


    <div class="second-box">

        <h2 class="description">
            <image class="head-image" src="../images/salary.png" />Secure your peace of mind on the road with a simple click...
            
        </h2>


    </div>


    <center>
        <div>


            <button class="payButton"><a href="paymentForm.php">Pay Online</a></button>

        </div>

        <br><br>
    </center>

    <div class="bank-box">

        <h2 class="bankHeading">The following Bank accounts are set up for your convenience</h2>


        <div class="bank-types">
            <image class="bank-image" src="../images/ntb-logo.jpeg" />

            <image class="bank-image" src="../images/boc.jpeg" />

            <image class="bank-image" src="../images/comm.jpeg" />

            <image class="bank-image" src="../images/hnb.jpeg" />

            <image class="bank-image" src="../images/sampath.jpeg" />
        </div>


        <div class="bank-details">
            <div>
                Acc. No: 024-100-003-840<br />

                Bank Code: 7162-024<br />

                Branch Code: 7162-024
            </div>

            <div class="bank-details_">
                Acc. No: 8012783<br />

                Bank Code: 7010<br />
                
                Branch Code: 660
            </div>

            <div class="bank-details_">
                Acc. No: 1416408301<br />

                Bank Code: 7056<br />

                Branch Code: 003
            </div>

            <div class="bank-details_">
                Acc. No: 0030-1051-8039<br />

                Bank Code: 7083<br />

                Branch Code: 003
            </div>

            <div class="bank-details_">
                Acc. No: 002930020780<br />

                Bank Code: 7278<br />

                Branch Code: 029
            </div>
        </div>



    </div>





    <?php
    include_once 'footer.php';
    ?>
</body>

</html>