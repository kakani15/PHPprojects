<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Server connection details
$servername = "localhost";
$username = "nikhnara";
$password = "pyre breaches warpaths inclined";
$db_name = "nikhnara_db";

// Check if user is logged in
if (!isset($_SESSION['aadhar'])) {
    // If not logged in, redirect to login page
    header("Location: admin.php");
    exit();
}

// Connect to the database
$con = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
    exit();
}

// Fetch options from the election commission table
$constituencyQuery = "SELECT * FROM constituencies";
$constituencyResult = mysqli_query($con, $constituencyQuery);

// Fetch options from the election commission table
$DistrictQuery = "SELECT DISTINCT constituency_district,district_id FROM constituencies";
$DistrictResult = mysqli_query($con, $DistrictQuery);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $voter_name = $_POST["voter_name"];
    $aadhar_card_number = $_POST["aadhar_card_number"];
    $voter_address = $_POST["voter_address"];
    $voter_id_number = $_POST["voter_id_number"];
    $voter_constituency_id = $_POST["voter_constituency_id"];
    $voter_district_id = $_POST["voter_district_id"];
    $voter_dob = $_POST["voter_dob"];

    // Construct SQL INSERT statement
    $insertQuery = "INSERT INTO election_commission (voter_name, aadhar_card_number, voter_address, voter_id_number, voter_constituency_id, voter_district_id, voter_dob) VALUES ('$voter_name', $aadhar_card_number, '$voter_address', $voter_id_number, $voter_constituency_id, $voter_district_id, '$voter_dob')";

    // Execute the INSERT statement
    if (mysqli_query($con, $insertQuery)) {
        echo "<p style='color: green;'>Voter added successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error adding voter: " . mysqli_error($con) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
            background-image: url('https://ichef.bbci.co.uk/news/976/cpsprodpb/40E3/production/_106311661_expander_index-03.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-color: #f5f5f5; /* Fallback color */
        }
    .container {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 13l-4-4h8l-4 4z"/></svg>') no-repeat right 10px center;
        background-size: 20px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #007bff;
        text-decoration: none;
    }

    button[type="submit"]:hover,
    .back-link:hover {
        background-color: #0056b3;
    }
    .navbar {
            background-color: #28a745;
            margin-bottom: 20px; /* Add margin bottom to create space between navbar and content */
        }

        .navbar-text {
            color: #ffc107;
            font-size: 28px;
            font-weight: bold;
            text-align : center;
        }


    </style>
</head>
<body>

    <div class="container">
    
        <h2>Add Voter</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Voter Name input -->
            <div class="form-group">
                <label for="voter_name">Voter Name</label>
                <input type="text" id="voter_name" name="voter_name" class="form-control" required>
            </div>

            <!-- Aadhar Card Number input -->
            <div class="form-group">
                <label for="aadhar_card_number">Aadhar Card Number</label>
                <input type="number" id="aadhar_card_number" name="aadhar_card_number" class="form-control" required>
            </div>

            <!-- Voter Address input -->
            <div class="form-group">
                <label for="voter_address">Voter Address</label>
                <textarea id="voter_address" name="voter_address" class="form-control" required></textarea>
            </div>

            <!-- Voter ID Number input -->
            <div class="form-group">
                <label for="voter_id_number">Voter ID Number</label>
                <input type="number" id="voter_id_number" name="voter_id_number" class="form-control" required>
            </div>

            <!-- Constituency ID dropdown -->
            <div class="form-group">
                <label for="voter_constituency_id">Constituency</label>
                <select id="voter_constituency_id" name="voter_constituency_id" class="form-control" required>
                    <?php
                    // Dynamically populate constituency options
                    while ($row = mysqli_fetch_assoc($constituencyResult)) {
                        echo "<option value='" . $row['constituency_id'] . "'>" . $row['constituency_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- District ID dropdown -->
            <div class="form-group">
                <label for="voter_district_id">District</label>
                <select id="voter_district_id" name="voter_district_id" class="form-control" required>
                    <?php
                    // Reset the result pointer
                    mysqli_data_seek($DistrictResult, 0);
                    // Dynamically populate district options
                    while ($row = mysqli_fetch_assoc($DistrictResult)) {
                        echo "<option value='" . $row['district_id'] . "'>" . $row['constituency_district'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Voter DOB input -->
            <div class="form-group">
                <label for="voter_dob">Voter Date of Birth</label>
                <input type="date" id="voter_dob" name="voter_dob" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Voter</button>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
    </div>
</body>
</html>
