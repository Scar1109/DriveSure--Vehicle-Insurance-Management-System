<?php 
    session_start();
    if(isset($_SESSION["userType"]) && $_SESSION["userType"] != 'admin'){
                header('location:userAcc.php');
                exit();
            }
    require_once 'includes/functions.inc.php';
    require_once 'includes/config.php';
    
    //delete user function
    if(isset($_GET["confirm_delete-u"])==false){
        if (isset($_GET["delete-u"])) {
            $UserID = $_GET["delete-u"];
            echo '<script>
                if (confirm("Are you sure you want to delete this row?")) {
                    window.location.href = window.location.origin + window.location.pathname + "?confirm_delete-u=true&delete-u=" + ' . $UserID . ';
                } else {
                    window.location.href = window.location.origin + window.location.pathname;
                }
            </script>';
        }
    }
    if (isset($_GET["confirm_delete-u"]) && $_GET["confirm_delete-u"] === "true") {
        $UserID = $_GET["delete-u"];
        deleteRow($con, 'users', $UserID, 'UserID');
        //save activity log
        logActivity($con,$_SESSION["userId"],'Deleted a user account',$_SESSION["userType"],$_SESSION["userName"]);
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }

    //delete vehicle function
    if(isset($_GET["confirm_delete-v"])==false){
        if (isset($_GET["delete-v"])) {
            $VehicleId = $_GET["delete-v"];
            echo '<script>
                if (confirm("Are you sure you want to delete this row?")) {
                    window.location.href = window.location.origin + window.location.pathname + "?confirm_delete-v=true&delete-v=" + ' . $VehicleId . ';
                } else {
                    window.location.href = window.location.origin + window.location.pathname;
                }
            </script>';
        }
    }
    if (isset($_GET["confirm_delete-v"]) && $_GET["confirm_delete-v"] === "true") {
        $VehicleId = $_GET["delete-v"];
        deleteRow($con, 'vehicledetails', $VehicleId,'VehicleID');
        //save activity log
        logActivity($con,$_SESSION["userId"],'Deleted a Vehicle',$_SESSION["userType"],$_SESSION["userName"]);
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }
    
    //User count from users table
    $userCount = getRowCount($con,'users');

    //Activity count from activity table
    $activityCount = getRowCount($con,'activitylogs');

    //Vehicle count from vehicle table
    $vehicleCount = getRowCount($con,'vehicledetails');

    //Getting activity logs
    $sql = "SELECT UserName, Log, Date, Time, UserType FROM activitylogs";
    $ActivityLogResult = $con->query($sql);

    //Getting user table details
    $sql = "SELECT UserName, UserID, FirstName, Email, RegistrationDate, RegistrationTime, UserType FROM users";
    $UsersResult = $con->query($sql);

    //Getting vehicle table details
    $sql = "SELECT VehicleID, RegistrationNumber, vehicleType, Model, ChassisNo, UserID FROM vehicledetails";
    $VehicleResult = $con->query($sql);

    //Getting user table details for edit section
    $sql = "SELECT UserName, UserID, FirstName, Email, RegistrationDate, RegistrationTime, UserType FROM users";
    $UsersResultEdit = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.styles.css">

    <!--change title icon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="path/to/logo.ico" type="image/x-icon">
    <title>DriveSure</title>
</head>

<body>
    
    <nav>
        <div class="logo">
            <div class="logo-image">
                <a href="index.php"><img src="../images/logo_Main.png" alt=""></a>
            </div>
        </div>
        <div class="menu-items">
            <ul class="navLinks">
                <li class="navList active">
                    <a href="#">
                        <ion-icon name="home-outline"></ion-icon>
                        <span class="links">Dashboard</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="people-outline"></ion-icon>
                        <span class="links">Users</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="person-outline"></ion-icon>
                        <span class="links">Edit User Roles</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="car-sport-outline"></ion-icon>
                        <span class="links">Vehicles</span>
                    </a>
                </li>
                <li class="navList">
                    <a href="#">
                        <ion-icon name="cloud-download-outline"></ion-icon>
                        <span class="links">Downloads</span>
                    </a>
                </li>
            </ul>
            <ul class="bottom-link">
                <li>
                    <a href="userAcc.php">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <span class="links">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="includes/logout.inc.php">
                        <ion-icon name="log-out-outline"></ion-icon>
                        <span class="links">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="container">
            <div class="overview">
                <div class="title">
                    <ion-icon name="speedometer"></ion-icon>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <ion-icon name="eye-outline"></ion-icon>
                        <span class="text">Total Views</span>
                        <span class="number"><?php echo getViewCount(); ?></span>
                    </div>
                    <div class="box box2">
                        <ion-icon name="people-outline"></ion-icon>
                        <span class="text">Active users</span>
                        <span class="number"><?php echo $userCount; ?></span>
                    </div>
                    <div class="box box3">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        <span class="text">Total Activities</span>
                        <span class="number"><?php echo $activityCount; ?></span>
                    </div>
                    <div class="box box4">
                        <ion-icon name="car-sport-outline"></ion-icon>
                        <span class="text">Insured Vehicles</span>
                        <span class="number"><?php echo $vehicleCount; ?></span>
                    </div>
                </div>
            </div>
            

            <!-- Activity log table -->
            <div class="data-table activityTable">
                <div class="title">
                    <ion-icon name="time-outline"></ion-icon>
                    <span class="text">Recent Activities</span>
                </div>
                <div class="table-design">
                    <?php
                    if ($ActivityLogResult->num_rows > 0) {
                        echo '<table class="activity">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Type</th>
                                        <th>Log</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $rowColor = 0; // Counter to track row colors
                                while($row = $ActivityLogResult->fetch_assoc()) {
                                    $rowColorClass = ($rowColor % 2 === 0) ? 'even' : 'odd'; // Determine row color class
                            
                                    echo '<tr class="' . $rowColorClass . '">
                                            <td>' . $row["UserName"] . '</td>
                                            <td>' . $row["UserType"] . '</td>
                                            <td>' . $row["Log"] . '</td>
                                            <td>' . $row["Date"] . '</td>
                                            <td>' . $row["Time"] . '</td>
                                        </tr>';
                            
                                    $rowColor++; // Increment row color counter
                                }
                            
                                echo '</tbody>
                                    </table>';
                            } else {
                                echo "No activity logs found.";
                            }
                    ?>
                </div>
            </div>
            
            <!-- User Details -->
            <div style="display:none" class="data-table userDetailsTable">
                <div class="title">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <span class="text">User Details</span>
                </div>
                <div class="table-design">
                    <?php
                    if ($UsersResult->num_rows > 0) {
                        echo '<table class="activity">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Registered Date</th>
                                        <th>Registered Time</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $rowColor = 0; // Counter to track row colors
                                while($row = $UsersResult->fetch_assoc()) {
                                    $rowColorClass = ($rowColor % 2 === 0) ? 'even' : 'odd'; // Determine row color class
                            
                                    echo '<tr class="' . $rowColorClass . '">
                                            <td>' . $row["UserName"] . '</td>
                                            <td>' . $row["FirstName"] . '</td>
                                            <td>' . $row["Email"] . '</td>
                                            <td>' . $row["RegistrationDate"] . '</td>
                                            <td>' . $row["RegistrationTime"] . '</td>
                                            <td>' . $row["UserType"] . '</td>
                                            <td>
                                                <a href="?delete-u=' . $row["UserID"] . '" class = "delete-btn"><ion-icon name="person-remove-outline"></ion-icon></ion-icon></a>
                                            </td>
                                        </tr>';
                            
                                    $rowColor++; // Increment row color counter
                                }
                            
                                echo '</tbody>
                                    </table>';
                            } else {
                                echo "No user logs found.";
                            }
                    ?>
                </div>
            </div>

            <!-- Edit user roles section -->
            <div style="display:none" class="data-table EditUserRole">
                <div class="title">
                    <ion-icon name="person-add-outline"></ion-icon>
                    <span class="text">Add User</span>
                </div>
                
                <div class="addUser">
                    <form action="includes/addUser.inc.php" method="post">
                        <fieldset class="addUser-field">
                            <div class="inline-input">
                                <div class="inputs">
                                    <label>First name:</label><br>
                                    <input type="text" name="firstName" placeholder="First name" required>
                                </div>
                                <div class="inputs">
                                    <label >Last name:</label><br>
                                    <input type="text" name="lastName" placeholder="Last name" required><br/>
                                </div>
                            </div>

                            <div class="inline-input">
                                <div class="inputs">
                                    <label>Username:</label><br>
                                    <input type="text" name="userName" placeholder="Username" pattern="[a-zA-Z0-9@_-]+" required>
                                </div>
                                <div class="inputs">
                                    <label>E-mail:</label><br>
                                    <input type="email" name="email" placeholder="abc@gmail.com" pattern="[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}"  required><br/>
                                </div>
                            </div>

                            <div class="inline-input">
                                <div class="inputs">
                                    <label>Choose your DOB:</label><br/>
                                    <input type="date" name="DOB"  required>
                                </div>
                                <div class="inputs">
                                <label>Mobile number:</label><br/>
                                <input type="tel" name="mobile" pattern="{0-9}{10}" placeholder="077-XXXXXXX" required>
                                </div>
                            </div>

                            <div class="Address">
                                <label>Address:</label><br/>
                                <textarea name="address" row="8" cols="50" placeholder="Address" required></textarea>
                            </div>

                            <div class="inline-input">
                                <div class="inputs">
                                    <label>NIC:</label><br>
                                    <input type="text" name="NIC" placeholder="NIC"  required>
                                </div>
                                <div class="inputs">
                                    <label>Gender:</label><br/>
                                    <div>
                                        <input type="radio" name="gender" value="nbspMale" checked> Male
                                        <input type="radio" name="gender" value="Female">Female
                                    </div>
                                </div>
                            </div>

                            <div class="inline-input">
                                <div class="inputs">
                                    <label>Password:</label><br/>
                                    <input type="password" name="pwd" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required><br/>
                                </div>
                                <div class="inputs">
                                    <label>User type:</label><br/>
                                    <input  type="text" name="userType" id="userType" placeholder="Enter user type" required><br/>
                                </div>
                            </div>
                            <div class="center">
                                <input type="submit" name="submit" value="Add" id="submitBtn">
                            </div> 
                        </fieldset>
                    </form>
                </div>

                <!-- Edit user -->
                <div class="title">
                    <ion-icon name="create-outline"></ion-icon>
                    <span class="text">Edit User Roles</span>
                </div>
                <div class="editForm">
                    <form action="includes/editUser.inc.php" method="POST">
                        <div class="inline-input">
                            <div class="inputs">
                                <label> Enter username or email :</label><br>
                                <input type="text" name="username" placeholder="Enter username or email" required>
                            </div>
                            <div class="inputs">
                                <label> Select type :</label><br>
                                <select name="userType" id="userType" required>
                                    <option value="user" selected>User</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <input type="submit" name="submit" value="Change">
                        </div>
                    </form>
                </div>
                            
                <!-- Redisplay user details -->
                <div class="table-design">
                    <?php
                    if ($UsersResultEdit->num_rows > 0) {
                        echo '<table class="activity">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Registered Date</th>
                                        <th>Registered Time</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $rowColor = 0; // Counter to track row colors
                                while($row = $UsersResultEdit->fetch_assoc()) {
                                    $rowColorClass = ($rowColor % 2 === 0) ? 'even' : 'odd'; // Determine row color class
                            
                                    echo '<tr class="' . $rowColorClass . '">
                                            <td>' . $row["UserName"] . '</td>
                                            <td>' . $row["FirstName"] . '</td>
                                            <td>' . $row["Email"] . '</td>
                                            <td>' . $row["RegistrationDate"] . '</td>
                                            <td>' . $row["RegistrationTime"] . '</td>
                                            <td>' . $row["UserType"] . '</td>
                                            <td>
                                                <a href="?delete-u=' . $row["UserID"] . '" class = "delete-btn"><ion-icon name="person-remove-outline"></ion-icon></ion-icon></a>
                                            </td>
                                        </tr>';
                            
                                    $rowColor++; // Increment row color counter
                                }
                            
                                echo '</tbody>
                                    </table>';
                            } else {
                                echo "No user logs found.";
                            }
                    ?>
                </div>

                
            </div>

            <!-- Vehicles section -->
            <div style="display:none" class="data-table VehicleDetails">
                <div class="title">
                    <ion-icon name="car-outline"></ion-icon>
                    <span class="text">Vehicles</span>
                </div>
            <div class="table-design">
                    <?php
                    if ($VehicleResult->num_rows > 0) {
                        echo '<table class="activity">
                                <thead>
                                    <tr>
                                        <th>Vehicle ID</th>
                                        <th>Vehicle Number</th>
                                        <th>Model</th>
                                        <th>Chassis Number</th>
                                        <th>Owner\'s UID</th>
                                        <th>Vehicle Type</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $rowColor = 0; // Counter to track row colors
                                while($row = $VehicleResult->fetch_assoc()) {
                                    $rowColorClass = ($rowColor % 2 === 0) ? 'even' : 'odd'; // Determine row color class
                            
                                    echo '<tr class="' . $rowColorClass . '">
                                            <td>' . $row["VehicleID"] . '</td>
                                            <td>' . $row["RegistrationNumber"] . '</td>
                                            <td>' . $row["Model"] . '</td>
                                            <td>' . $row["ChassisNo"] . '</td>
                                            <td>' . $row["UserID"] . '</td>
                                            <td>' . $row["vehicleType"] . '</td>
                                            <td>
                                                <a href="?delete-v=' . $row["VehicleID"] . '" class = "delete-btn"><ion-icon name="close-circle-outline"></ion-icon></ion-icon></a>
                                            </td>
                                        </tr>';
                            
                                    $rowColor++; // Increment row color counter
                                }
                            
                                echo '</tbody>
                                    </table>';
                            } else {
                                echo "No Vehicles found.";
                            }
                    ?>
                </div>
                </div>

            <!-- Downloads section -->
            <div style="display:none" class="data-table downloads">
                <div class="title">
                    <ion-icon name="download-outline"></ion-icon>
                    <span class="text">Download Table Details</span>
                </div>

                <div class="table-design">
                    <?php
                    $userDetails = downloadDataSheet($con, 'users');
                    $vehicleDetails = downloadDataSheet($con, 'vehicledetails');
                    $PolicyDetails = downloadDataSheet($con, 'policydetails');
                    $accidentDetails = downloadDataSheet($con, 'accidentdetails');
                    $paymentDetails = downloadDataSheet($con, 'payment');
                    $claimDetails = downloadDataSheet($con, 'claimdetails');
                    $activityLog = downloadDataSheet($con, 'activitylogs');

                        echo '<table class="activity">
                                <thead>
                                    <tr>
                                        <th>Table name</th>
                                        <th>Row count</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr class="even">
                                    <td>User Table</td>
                                    <td>' . getRowCount($con,'users') . '</td>
                                    <td><a href="' . $userDetails . '" download style="color:inherit; padding-left:30px;">
                                        <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                        </a></td>
                                </tr>
                                <tr class="odd">
                                    <td>Vehicle Details</td>
                                    <td>' . getRowCount($con,'vehicledetails') . '</td>
                                    <td><a href="' . $vehicleDetails . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr>
                                <tr class="even">
                                    <td>Policy Details</td>
                                    <td>' . getRowCount($con,'policydetails') . '</td>
                                    <td><a href="' . $PolicyDetails . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr>
                                <tr class="odd">
                                    <td>Accident Details</td>
                                    <td>' . getRowCount($con,'accidentdetails') . '</td>
                                    <td><a href="' . $accidentDetails . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr>
                                <tr class="even">
                                    <td>Payment Details</td>
                                    <td>' . getRowCount($con,'claimdetails') . '</td>
                                    <td><a href="' . $paymentDetails . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr>
                                <tr class="odd">
                                    <td>Claim Details</td>
                                    <td>' . getRowCount($con,'claimdetails') . '</td>
                                    <td><a href="' . $claimDetails . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr>
                                <tr class="even">
                                    <td>Activity Log</td>
                                    <td>' . getRowCount($con,'activitylogs') . '</td>
                                    <td><a href="' . $activityLog . '" download style="color:inherit; padding-left:30px;">
                                    <ion-icon style ="font-size:30px" name="download-outline"></ion-icon>
                                    </a></td>
                                </tr></tbody>
                                    </table>';

                    ?>
                </div>
            </div>

            </div>
    </section>
    <?php
    
    //error handling
    if(isset($_GET["error"])){
        if($_GET["error"]== 'noError'){
            echo '<script>alert("User account addition successful.");</script>';
        }
        elseif($_GET["error"] == 'userExists'){
            echo '<script>alert("User already exist.");</script>';
        }
        elseif($_GET["error"]=='DatabaseError'){
            echo '<script>alert("Error connecting database. Please try again.");</script>';
        }
        elseif($_GET["error"]=='success-edtUsr'){
            echo '<script>alert("Role change was successful.");</script>';
        }
        elseif($_GET["error"]=='UsernameDoesNotExist'){
            echo '<script>alert("Wrong username");</script>';
        }
        echo '<script>window.location.href = window.location.origin + window.location.pathname;</script>';
    }
    ?>

    <script src="../js/admin.scripts.js"></script>
    
    <!-- Sources for icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>

</html>