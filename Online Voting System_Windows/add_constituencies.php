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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $district_id = $_POST["district_id"];
    $constituency_name = $_POST["constituency_name"];
    $constituency_district = strtolower($_POST["constituency_district"]); // Convert to lowercase
    $no_of_votes = $_POST["no_of_votes"];

    // Check if constituency already exists
    $checkQuery = "SELECT * FROM constituencies WHERE district_id = $district_id AND constituency_name = '$constituency_name'";
    $checkResult = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "<p style='color: red;'>This constituency already exists.</p>";
    } else {
        // Construct SQL INSERT statement
        $insertQuery = "INSERT INTO constituencies (district_id, constituency_name, constituency_district, no_of_votes) VALUES ($district_id, '$constituency_name', '$constituency_district', $no_of_votes)";

        // Execute the INSERT statement
        if (mysqli_query($con, $insertQuery)) {
            echo "<p style='color: green;'>Constituency added successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error adding constituency: " . mysqli_error($con) . "</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Constituency</title>
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
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
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
    </style>
</head>
<body>

    <div class="container">
    
        <h2>Add Constituency</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- District ID input -->
            <div class="form-group">
                <label for="district_id">District ID</label>
                <input type="number" id="district_id" name="district_id" class="form-control" required>
            </div>

            <!-- Constituency Name input -->
            <div class="form-group">
                <label for="constituency_name">Constituency Name</label>
                <input type="text" id="constituency_name" name="constituency_name" class="form-control" required>
            </div>

            <!-- Constituency District input -->
            <div class="form-group">
                <label for="constituency_district">Constituency District</label>
                <input type="text" id="constituency_district" name="constituency_district" class="form-control" required>
            </div>

            <!-- No. of Votes input -->
            <div class="form-group">
                <label for="no_of_votes">No. of Votes</label>
                <input type="number" id="no_of_votes" name="no_of_votes" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Constituency</button>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
    </div>
</body>
</html>
