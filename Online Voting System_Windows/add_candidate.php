<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

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

// Fetch constituencies from the database
$constituencyQuery = "SELECT * FROM constituencies";
$constituencyResult = mysqli_query($con, $constituencyQuery);

// Fetch districts from the database
$districtQuery = " SELECT DISTINCT constituencies.constituency_district, constituencies.district_id FROM constituencies;";
$districtResult = mysqli_query($con, $districtQuery);

$partyQuery = "SELECT * FROM parties";
$partyResult = mysqli_query($con, $partyQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $candidate_name = $_POST["candidate_name"];
    $candidate_age = $_POST["candidate_age"];
    $candidate_img = $_POST["candidate_img"];
    $candidate_party_id = $_POST["candidate_party_id"];
    $candidate_dob = $_POST["candidate_dob"];
    $candidate_constituency_id = $_POST["candidate_constituency_id"];
    $candidate_district_id = $_POST["candidate_district_id"];
    $candidate_role = $_POST["candidate_role"];
    $candidate_net_worth = $_POST["candidate_net_worth_crores"]; // Added missing semicolon
    $candidate_criminal_cases = $_POST["candidate_criminal_cases"];

    // Construct SQL INSERT statement
    $insertQuery = "INSERT INTO candidates (candidate_name, candidate_age, candidate_img, candidate_party_id, candidate_dob, candidate_constituency_id, candidate_district_id, candidate_role, `candidate_net_worth(crores)`, candidate_criminal_cases) VALUES ('$candidate_name', $candidate_age, '$candidate_img', $candidate_party_id, '$candidate_dob', $candidate_constituency_id, $candidate_district_id, '$candidate_role', '$candidate_net_worth', '$candidate_criminal_cases')";

    // Execute the INSERT statement
    if (mysqli_query($con, $insertQuery)) {
        echo "<p style='color: green;'>Candidate added successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error adding candidate: " . mysqli_error($con) . "</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
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
    
        <h2>Add Candidate</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Candidate Name input -->
            <div class="form-group">
                <label for="candidate_name">Candidate Name</label>
                <input type="text" id="candidate_name" name="candidate_name" class="form-control" required>
            </div>

            <!-- Candidate Age input -->
            <div class="form-group">
                <label for="candidate_age">Candidate Age</label>
                <input type="number" id="candidate_age" name="candidate_age" class="form-control" required>
            </div>

            <!-- Candidate Image input -->
            <div class="form-group">
                <label for="candidate_img">Candidate Image(Paste img Address)</label>
                <input type="text" id="candidate_img" name="candidate_img" class="form-control">
            </div>

            <!-- Candidate Party ID input -->
            <div class="form-group">
                <label for="candidate_party_id">Candidate Party ID</label>
                <select id="candidate_party_id" name="candidate_party_id" class="form-control" required>
                    <?php
                    // Dynamically populate party options
                    while ($row = mysqli_fetch_assoc($partyResult)) {
                        echo "<option value='" . $row['party_id'] . "'>" . $row['party_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Candidate DOB input -->
            <div class="form-group">
                <label for="candidate_dob">Candidate Date of Birth</label>
                <input type="date" id="candidate_dob" name="candidate_dob" class="form-control" required>
            </div>

            <!-- Constituency ID dropdown -->
            <div class="form-group">
                <label for="candidate_constituency_id">Constituency ID</label>
                <select id="candidate_constituency_id" name="candidate_constituency_id" class="form-control" required>
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
                <label for="candidate_district_id">District ID</label>
                <select id="candidate_district_id" name="candidate_district_id" class="form-control" required>
                    <?php
                    // Dynamically populate district options
                    while ($row = mysqli_fetch_assoc($districtResult)) {
                        echo "<option value='" . $row['district_id'] . "'>" . $row['constituency_district'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Candidate Role input -->
            <div class="form-group">
                <label for="candidate_role">Candidate Role</label>
                <input type="text" id="candidate_role" name="candidate_role" class="form-control" required>
            </div>

            

            <!-- Candidate Net Worth input -->
<div class="form-group">
    <label for="candidate_net_worth_crores">Candidate Net Worth (Crores)</label>
    <input type="number" id="candidate_net_worth_crores" name="candidate_net_worth_crores" class="form-control" required>
</div>


            <!-- Candidate Criminal Cases input -->
            <div class="form-group">
                <label for="candidate_criminal_cases">Candidate Criminal Cases</label>
                <input type="text" id="candidate_criminal_cases" name="candidate_criminal_cases" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Candidate</button>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
    </div>
</body>
</html>
