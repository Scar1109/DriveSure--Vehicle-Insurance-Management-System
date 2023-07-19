<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index.styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>
</head>

<body>
    <?php
        include_once 'header.php';
        require_once 'includes/functions.inc.php';
        incrementViewCount(); //Calculating website View count
    ?>

    <!--slide show -->

    <div class="slideshow">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="../images/1.svg" style="width:100%; height:auto;" >
            </div>
            <div class="mySlides fade">
                <img src="../images/2.svg" style="width:100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/3.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/4.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/5.svg" style="width: 100%; height:auto;">
            </div>
        </div>
        <br>

        <div class="dots" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
                <span class="dot" onclick="currentSlide(5)"></span> 
        </div>
    </div>

    <!-- sub heading -->
    <div id="selectCategory"></div>
    <hr style="color:black; margin: 0px 100px; border:1px solid black">

    <div style="margin-left: 150px; margin-top:40px;">
        <h1>The #1 Rated Insurance </h1>
        <h4 class="sub-heading1">get a quote in the blink of an eye</h4>
    </div>
    <!-- category selection section-->

        <div class="list1">
            <ul class="outerDiv">
                <a href="register.php?topic=car">
                    <li class="shape01">
                        <img src="../images/car.png" alt="car">
                        <h3>Car</h3>
                    </li>
                </a>
                <a href="register.php?topic=motorcycle">
                    <li class="shape02">
                        <img src="../images/bike.png" alt="Motorcycle">
                        <h3>Motorcycle</h3>
                    </li>
                </a>
                <a href="register.php?topic=three-wheeler">
                    <li class="shape03">
                        <img src="../images/threewheel.png" alt="Three-Wheel">
                        <h3>Three Wheel</h3>
                    </li>
                </a>
                <a href="register.php?topic=commercial-vehicle">
                <li class="shape04">
                    <img src="../images/lorry.png" alt="Commercial Vehicle">
                    <h3>Commercial<br>Vehicle</h3>
                </li>
                </a>
            </ul>
        </div>

    <hr style="color:black; margin: 0px 100px; border:1px solid black">

    <!--Quick access links-->
    <div class="container">
    <img src="../images/lawyer-for-car-accident.jpg" alt="Accident" class="QAimg">
    <div class="content">
        <h1 class="topic">Get Instant Access to Claims and Your Policy</h1>
        <ul class="Link-set">
            <li><a href="login.php">Log In to Your Policy<i class="fa fa-chevron-right"></i></a></li>
            <li><a href="index.php#selectCategory">Register New Vehicle<i class="fa fa-chevron-right"></i></a></li>
            <li><a href="renew.php">Renew Policy<i class="fa fa-chevron-right"></i></a></li>
            <li><a href="claim.php">Report a Claim<i class="fa fa-chevron-right"></i></a></li>
        </ul>
    </div>
    </div>

    <hr style="color:black; margin: 0px 100px; border:1px solid black">
    
    <!--Video section-->
    <div class="video-section">
        <div class="content">
            <h1>15 Defensive Driving Secrets That Can Save Your Life...</h1>
            <p>Defensive driving secrets are valuable tips and techniques that enable drivers to stay safe on the road. They involve maintaining awareness of the surroundings, anticipating hazards, and reacting promptly. <br><br>Keeping a safe distance from other vehicles, regularly checking mirrors, and scanning the road for potential dangers are key aspects.Remaining calm and patient in challenging situations is also important. These secrets empower drivers to take control of their safety and minimize risks on the road.</p>
        </div>
    <div class="video-wrapper">
        <iframe id="video-play" width="560" height="315" src="https://www.youtube.com/embed/UnqOmbR2qNs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen autoplay></iframe>
    </div>
    </div>
<!-- error handling-->
<?php
		if(isset($_GET["message"])){
			if($_GET["message"]=='policy-success'){
				echo '<script>alert("Vehicle registration was successful. Wait for the quote.");</script>';
			}
            elseif($_GET["message"]=='success-payment'){
				echo '<script>alert("Your payment was successful.");</script>';
			}
			echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
		}
	?>
    <?php
        include_once 'footer.php';
    ?>
    <script src="../js/myscript.js"></script>
</body>
</html>