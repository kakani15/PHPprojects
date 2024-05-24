<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Server connection details
$servername = "localhost";
$username = "nikhnara";
$password = "pyre breaches warpaths inclined";
$db_name = "nikhnara_db";

// Connect to the database
$con = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $aadhar = $_POST['aadhar'];
    $voter_id = $_POST['voter_id'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if Aadhar card already exists in Voters table
    $check_sql = "SELECT * FROM voters WHERE aadhar_card_number = '$aadhar'";
    $check_result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Aadhar card already registered
        echo "<p style='color: red;'>This Aadhar card number is already registered.</p>";
    } else {
        // Check if Aadhar card exists and associated details are correct
        $verify_sql = "SELECT * FROM election_commission WHERE aadhar_card_number = '$aadhar' AND voter_id_number = '$voter_id' AND voter_dob = '$dob'";
        $verify_result = mysqli_query($con, $verify_sql);

        if (mysqli_num_rows($verify_result) > 0) {
            // Aadhar card and associated details found, insert into Voters table
            $insert_sql = "INSERT INTO voters (aadhar_card_number, voter_name, voter_dob, voter_address, password, voter_emailID, voter_constituency_id, voter_district_id) 
                           SELECT aadhar_card_number, voter_name, voter_dob, voter_address, '$password', '$email', voter_constituency_id, voter_district_id 
                           FROM election_commission 
                           WHERE aadhar_card_number = '$aadhar' AND voter_id_number = '$voter_id' AND voter_dob = '$dob'";
            
            if (mysqli_query($con, $insert_sql)) {
                echo "<p style='color: green;'>Registration successful</p>";
                header("Location: Welcome_page.php");
            } else {
                echo "<p style='color: red;'>Error inserting data into Voters table: " . mysqli_error($con) . "</p>";
                header("Location: Welcome_page.php");
            }
        } else {
            // Aadhar card or associated details not found
            echo "<p style='color: red;'>Record not found in Election Commission database. Please contact Election Commission.</p>";
        }
    }
}

// Close database connection
mysqli_close($con);
?>
