<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="../css/signup.styles.css">
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

	<!--Greeting-->
	<span class="greeting center">
		<?php 
			include_once 'includes/functions.inc.php';
			echo generateGreeting(); 
		?>
	</span>

	<!--Signup form-->
	<div class="signup-container">
		<form action="includes/signup.inc.php" method="post">
			<fieldset class="signup-field">
				<span class="center">We need some information to match you to DriveSure</span>
				<div class="inline-input">
					<div class="inputs">
						<label>First name:</label><br>
						<input type="text" name="firstName" placeholder="First name" title="Enter your first name" required>
					</div>
					<div class="inputs">
						<label >Last name:</label><br>
						<input type="text" name="lastName" placeholder="Last name" title="Enter your last name" required><br/>
					</div>
				</div>

				<div class="inline-input">
					<div class="inputs">
						<label>Username:</label><br>
						<input type="text" name="userName" placeholder="Username" pattern="[a-zA-Z0-9@_-]+" title="Username must contain only letters (both lowercase and uppercase), numbers, @, _, or -." required>
					</div>
					<div class="inputs">
						<label>E-mail:</label><br>
						<input type="email" name="email" placeholder="abc@gmail.com" pattern="[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}" title="Enter a valid email" required><br/>
					</div>
				</div>

				<div class="inline-input">
					<div class="inputs">
						<label>Choose your DOB:</label><br/>
						<input type="date" name="DOB" title="Choose your date of birth" required>
					</div>
					<div class="inputs">
					<label>Mobile number:</label><br/>
					<input type="tel" name="mobile" pattern="{0-9}{10}" placeholder="077-XXXXXXX" title="Enter your mobile number" required>
					</div>
				</div>

				<div class="Address">
					<label>Address:</label><br/>
					<textarea name="address" row="8" cols="50" placeholder="Address" title="Enter your address" required></textarea>
				</div>

				<div class="inline-input">
					<div class="inputs">
						<label>NIC:</label><br>
						<input type="text" name="NIC" placeholder="NIC" title="Enter your valid NIC number" required>
					</div>
					<div class="inputs">
						<label>Gender:</label><br/>
						<div>
							<input type="radio" name="gender" value="Male" checked> Male
							<input type="radio" name="gender" value="Female">Female
						</div>
					</div>
				</div>

				<div class="inline-input">
					<div class="inputs">
						<label>Password:</label><br/>
						<input type="password" name="pwd" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" title="Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one digit." required><br/>
					</div>
					<div class="inputs">
						<label>Re-enter Password:</label><br/>
						<input  type="password" name="repeat-pwd" id="pwdRepeat" placeholder="Re-enter password" title="Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one digit." required><br/>
					</div>
				</div>
				<input type="checkbox" id="checkbox" onclick="enableSubmit();"> <lable>Agree terms & conditions</lable><br><br>
				<div class="center">
					<input type="submit" name="submit" value="Register" id="submitBtn" disabled>
				</div> 
				<div class="id-login center">
					<span class="have-acc">Already have an account? </span><br></br>
					<span class="loginto"> <a href="login.php"> Click here</a></span>
				</div>
			</fieldset>
		</form>
	</div>
	
	<!-- error handling-->
	<?php
		if(isset($_GET["error"])){
			if($_GET["error"]=='emptyInputs'){
				echo '<script>alert("One or more inputs are empty. Try again.");</script>';
			}
			elseif($_GET["error"]== 'passwordMissMatch'){
				echo '<script>alert("Passwords are not same. Try again.");</script>';
			}
			elseif($_GET["error"] == 'userExists'){
				echo '<script>alert("User already exist.");</script>';
			}
			elseif($_GET["error"]=='DatabaseError'){
				echo '<script>alert("Error connecting database. Please try again.");</script>';
			}
			echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
		}
	?>
	
	<!--include footer-->
    <?php
        include_once 'footer.php';
    ?>
	<script src="../js/myscript.js"></script>
</body>
</html>