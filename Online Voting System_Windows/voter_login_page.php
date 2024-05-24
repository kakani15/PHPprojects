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
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $aadhar = $_POST['aadhar'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

    // SQL query to check login credentials
    $sql = "SELECT * FROM voters WHERE aadhar_card_number = '$aadhar' AND password = '$password' AND voter_dob = '$dob'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        // Start session
        session_start();
        // Store aadhar card number in session
        $_SESSION['aadhar'] = $aadhar;
        // Redirect to home page
        header("Location: voter_home_page.php");
        exit();
    } else {
        // Login failed
        echo "<div class='alert alert-danger' role='alert'>Invalid login credentials. Please try again.</div>";
    }
}

// Close database connection
mysqli_close($con);
?>
