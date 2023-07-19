<?php
        $current_page = basename($_SERVER['PHP_SELF']);
        session_start();
?>

<div class="headSquare">
        <a href="index.php">
                <img class="logo" src="../images/logo_Main.png" alt="logo" >
        </a>

        <?php
        if (isset($_SESSION["userName"])) {
        echo '
        <div class="user-dropdown">
                <a href="userAcc.php" class="loggedInUser">
                <i class="fa fa-user-circle-o" style="font-size:36px"></i>
                </a>
                <a href="userAcc.php" class="loggedInUserText">
                <p>' . $_SESSION["userName"] . '</p>
                </a>
                <div class="user-dropdown-content">
                        <a href="userAcc.php">Account details</a>
                        <a href="includes/logout.inc.php">Log out</a>
                </div>
        </div>';
        } else {
        echo '
        <a href="login.php" class="logIn">
        <i class="fa fa-user-circle-o" style="font-size:36px"></i>
        </a>
        <a href="login.php" class="logInText">
                <p>Log in</p>
        </a>';
        }
        ?>
</div>

<ul class="headerNav">
        <li <?php if($current_page === 'index.php') echo ' class="active"'; ?>><a href="index.php">Home</a></li>
        <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Vehicle Category <i class="fa fa-angle-down"></i></a>
                <div class="dropdown-content">
                        <a href="register.php?topic=car">Car Insurance</a>
                        <a href="register.php?topic=motorcycle">Motorcycle Insurance</a>
                        <a href="register.php?topic=three-wheeler">Three-Wheeler Insurance</a>
                        <a href="register.php?topic=commercial-vehicle">Commercial Vehicle Insurance</a>
                </div>
        </li>
        <li <?php if($current_page === 'renew.php') echo ' class="active"'; ?>><a href="renew.php">Renew Policy</a></li>
        <li <?php if($current_page === 'claim.php' or $current_page === 'claimForm.php') echo ' class="active"'; ?>><a href="claim.php">Request Claim</a></li>
        <li <?php if($current_page === 'about.php') echo ' class="active"'; ?>><a href="about.php">About Us</a></li>
        <li <?php if($current_page === 'contact.php') echo ' class="active"'; ?>><a href="contact.php">Contact Us</a></li>
        <div class="search-container">
                <form action="includes/search.inc.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                </form>
        </div>
</ul>


