<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/login.styles.css">
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

    <!--Greeting massage-->
    <span class="greeting center">
            <?php 
                include_once 'includes/functions.inc.php';
                echo generateGreeting(); 
            ?>
    </span>

        <div class="loginForm center">
            <fieldset>
            <form action="includes/login.inc.php" method="POST">
                <span class="login-lable">Log into get started</span>
                <input type="text" name="email" placeholder="Username or E-mail"><br>
                <input type="password" name="Password" placeholder="Password"><br>
                <span class="terms-lable">By clicking log in you agree to <u>Terms and conditions.</u></span>
                <input  type="submit" name="submit" value="Log in" ><br>

                <span class="customer">Not a DriveSure Customer?</span><br>
                <span class="registerTxt">You can register for an account.&nbsp<a href="signup.php">create account</a></span>
            </form>
            </fieldset>
        </div>
        <br>

    <!-- error handling-->
	<?php
		if(isset($_GET["error"])){
			if($_GET["error"]=='emptyInputs'){
				echo '<script>alert("One or more inputs are empty. Try again.");</script>';
			}
			elseif($_GET["error"]== 'WrongPassword'){
				echo '<script>alert("Password not match. Try again.");</script>';
			}
			elseif($_GET["error"] == 'UsernameDoesNotExist'){
				echo '<script>alert("User does not exist. Check the email ant try again.");</script>';
			}
            elseif($_GET["error"] == 'pleaseLogin-claim'){
				echo '<script>alert("You can not request a claim without login. Please log in!");</script>';
			}
            elseif($_GET["error"] == 'pleaseLogin-vehicle'){
				echo '<script>alert("You can not register a vehicle without login. Please log in!");</script>';
			}
            echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
		}
	?>

    <?php
        include_once 'footer.php';
    ?>
</body>
</html>