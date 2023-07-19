<?php

//generate greeting by time
function generateGreeting() {
    $hour = date('G');

    if ($hour >= 5 && $hour < 12) {
        return "Good morning !";
    } elseif ($hour >= 12 && $hour < 17) {
        return "Good afternoon !";
    } else {
        return "Good evening !";
    }
}

// View count calc
function incrementViewCount() {
    $countFile = 'view_count.txt';

    // Check if the count file exists
    if (file_exists($countFile)) {
        $count = file_get_contents($countFile);
        $count = intval($count); // Convert the count to an integer
    } else {
        $count = 0;
    }
    $count++;

    file_put_contents($countFile, $count);
}

//display view count
function getViewCount() {
    $countFile = 'view_count.txt';

    if (file_exists($countFile)) {
        $count = file_get_contents($countFile);
        $count = intval($count); // Convert the count to an integer
        return $count;
    } else {
        return 0;
    }
}


//functions of signup page
function emptyInputSignup($inputs) {
    foreach ($inputs as $input) {
        if (empty($input)) {
            return true;
        }
    }
    return false;
}

function passwordMatch($pwd, $repeatPwd){
    if($pwd !== $repeatPwd){
        return true;
    }
    else{
        return false;
    }
}

function userExistsSignup($con, $usersname, $email, $nic){

    $sql = "SELECT * FROM Users WHERE UserName = ? OR Email = ? OR NIC = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $usersname, $email,$nic);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    return $result->num_rows > 0;
}

//For login
function emptyInputLogin($email, $Password){
    if(empty($email) || empty($Password) ){
        return true;
    }
    return false;
}

//save data to Activity log
function logActivity($con,$userId,$log,$userType,$username){
    $sql = "INSERT INTO activitylogs (UserID, Log, UserName, UserType) VALUES('$userId','$log','$username','$userType')";
    $con->query($sql);
}

//generate unique name for files
function generateUniqueFileName($fileName,$ID,$type) {
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $timestamp = time(); // Current timestamp

    // Concatenate the timestamp, ID, and file extension
    $uniqueFileName = $timestamp . '_' . $ID . '_' . $type . '.' . $fileExtension;

    return $uniqueFileName;
}

// Function to delete a row from the table based on ID
function deleteRow($con, $tableName, $id,$columnName) {
    // Disable foreign key checks
    $con->query("SET FOREIGN_KEY_CHECKS = 0");
    $stmt = $con->prepare("DELETE FROM $tableName WHERE $columnName = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    // Enable foreign key checks
    $con->query("SET FOREIGN_KEY_CHECKS = 1");
}

//Download database tables
function downloadDataSheet($con, $tableName)
{
    // Retrieve column details from the table
    $columnsSql = "SHOW COLUMNS FROM $tableName";
    $columnsResult = $con->query($columnsSql);

    if ($columnsResult && $columnsResult->num_rows > 0) {
        // File path for the CSV file
        $filePath = "../data/".$tableName."_data_sheet.csv";

        // Open the CSV file for writing
        $file = fopen($filePath, "w");

        if ($file !== false) {
            // Write the column headers
            $headers = array();
            while ($row = $columnsResult->fetch_assoc()) {
                $headers[] = $row['Field'];
            }
            fputcsv($file, $headers);

            // Retrieve data from the table
            $dataSql = "SELECT * FROM $tableName";
            $dataResult = $con->query($dataSql);

            if ($dataResult && $dataResult->num_rows > 0) {
                // Write the data rows
                while ($rowData = $dataResult->fetch_assoc()) {
                    fputcsv($file, $rowData);
                }
            }

            // Close the file
            fclose($file);

            // Provide a download link for the generated CSV file
            return $filePath;
        }
    }
}

//Calculate row count of the table
function getRowCount($con, $tableName) {
    $query = "SELECT COUNT(*) AS rowCount FROM $tableName";
    
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Error executing query: " . mysqli_error($con));
    }
    
    $row = mysqli_fetch_assoc($result);
    $rowCount = $row['rowCount'];
    return $rowCount;
}





