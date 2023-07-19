<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/contact.styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>

</head>
<body>
<?php
        include_once 'header.php';
    ?>

	<div class="container">
    <div class="banner">
        <h1><center>Connect With Us </center></h1>
    </div>
</div>	
	
	
	<div class="bgimg">
		<div class="overlay">
	    <p class="fab">"Hi! We value your presence and would love for you to 
		join our community.
		Connect with us to stay updated on the latest news, offers,
		and exciting opportunities. 
		Join with us today !"</p> 
		
				
			
		</div>	
	</div>
	
	<div class="contact-info">
	    <p class="deco">C O N T A C T  &nbsp &nbsp I N F O R M A T I O N</p>
	<div class ="shade">
    <p class="cntactinfopara">&nbsp Call Our 24/7 Service Line : &nbsp 0 1 1 - 29 033 01</p>
	<p class="cntactinfopara">&nbsp Fax Us : &nbsp 0 7 1 - 21 167 04</p>
    <p class="cntactinfopara">&nbsp E-mail Us  : &nbsp <a href="www.gmail.com">Drivesafe@gmail.com</a></p>
    <p class="cntactinfopara">&nbsp Visit us at : &nbsp 28B Rosewell Road, Colombo 07</p><br/><br/>
	
    </div>

    <div class="form-container">
    <h2 class="deco">I  N  Q  U  I  R  Y &nbsp &nbsp  F  O  R  M </h2>
    <form action="includes/contact.inc.php" method="POST">
	
        <input type="text" size="35" name="name" placeholder="Your Name" required> <br/><br/>
        <input type="email" size="35" name="email" placeholder="Your Email" required> <br/><br/>
		<input type="text" size="35" name="mobilenum" placeholder="Your Number" required ><br/><br/> 
        <textarea name="message" name="message" rows="5" column="50" placeholder="Type Your Message" required></textarea> <br/><br/>
        <button type="submit" class="btncls">Submit</button>
		
    </form>
    </div>
	
    <h3 class="deco">F r e q u e n t l y &nbsp  A s k e d  &nbsp Q u e s t i o n s</h3>
	<div class="faq-container"> 
    <ul>
	<p><li><strong>Q: What types of vehicle insurance do you offer?</strong><p></li>
        <li>A: We offer a range of insurance options, including comprehensive coverage, third-party liability, collision coverage, and more. You can choose the type of insurance that best suits your needs.</li>
        <p><li><strong>Q: How can I get a quote for my vehicle insurance?</strong><p> </li>
        <li>A: Getting a quote is easy! Simply visit our website and fill out the online quote form with your vehicle information, personal details, and coverage preferences. Our system will generate a quote based on the information provided.</li>
        <p><li><strong>Q: Can I insure multiple vehicles under the same policy?</strong><p></li>
        <li>A: Yes, we offer multi-vehicle insurance policies that allow you to insure multiple vehicles under a single policy. This can help simplify your insurance management and may offer cost savings as well.</li>
        <p><li><strong>Q: What factors affect the cost of my vehicle insurance?</strong></p></li>
		<li>A: Several factors can influence the cost of your insurance, including your driving history, vehicle make and model, age, location, and coverage options chosen. These factors help determine the level of risk associated with insuring your vehicle.</li>
		<p><li><strong>Q: How do I file a claim if my vehicle is involved in an accident?</strong></p></li>
		<li>A: In the event of an accident, you can file a claim by contacting our claims department through the provided contact information on our website. Our team will guide you through the claims process and assist you in submitting the necessary documentation.</li>
    </ul>
    </div>
    </div>
    <?php
        include_once 'footer.php';
    ?>

    <!-- error handling-->
	<?php
		if(isset($_GET["error"])){
			if($_GET["error"]=='DatabaseError'){
				echo '<script>alert("Error with database connection. Try again.");</script>';
			}
			elseif($_GET["error"]== 'No-error'){
				echo '<script>alert("Inquire submission was successful.");</script>';
			}
            echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
		}
	?>
</body>
</html>