<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if user is logged in
if(!isset($_SESSION['aadhar'])) {
    // Redirect to login page if user is not logged in
    header("Location: voter_login.html");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "nikhnara";
$password = "pyre breaches warpaths inclined";
$db_name = "nikhnara_db";

// Create connection
$con = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve candidate_id from the URL
if(isset($_GET['candidate_id'])) {
    $candidate_id = $_GET['candidate_id'];

    // Query the database to get candidate details
    $candidate_query = "SELECT candidate_name, candidate_dob, candidate_role, `candidate_net_worth(crores)`, candidate_criminal_cases, candidate_img FROM candidates WHERE candidate_id = $candidate_id";
    $candidate_result = mysqli_query($con, $candidate_query);

    if ($candidate_result && mysqli_num_rows($candidate_result) > 0) {
        $candidate_row = mysqli_fetch_assoc($candidate_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Portfolio</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            background-image: url('https://horasis.org/wp-content/uploads/Vote.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .candidate-info {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .candidate-info img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-right: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .candidate-details {
            flex: 1;
        }
        .candidate-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #007bff;
            font-size: 24px;
        }
        .candidate-details p {
            margin: 5px 0;
            line-height: 1.6;
            color: #555;
        }
        .money-symbol::before {
            content: "\20B9"; /* Indian Rupee symbol */
            margin-right: 5px;
        }
        .law-symbol::before {
            content: "\2696"; /* Law symbol */
            margin-right: 5px;
        }
        .btn-back {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Candidate Portfolio</h1>
        </div>
        <div class="candidate-info">
            <img src="<?php echo $candidate_row['candidate_img']; ?>" alt="<?php echo $candidate_row['candidate_name']; ?>">
            <div class="candidate-details">
                <h2><?php echo $candidate_row['candidate_name']; ?></h2>
                <p><strong>Date of Birth:</strong> <?php echo $candidate_row['candidate_dob']; ?></p>
                <p><strong>Role:</strong> <?php echo $candidate_row['candidate_role']; ?></p>
                <p><strong>Net Worth:</strong> <span class="money-symbol"><?php echo $candidate_row['candidate_net_worth(crores)']; ?></span> crores</p>
                <p><strong>Criminal Cases:</strong> <span class="law-symbol"><?php echo $candidate_row['candidate_criminal_cases']; ?></span></p>
                <button class="btn-back" onclick="window.location.href='voter_home_page.php'">Back to Voting page</button>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Candidate not found.";
    }
} else {
    echo "Candidate ID not provided.";
}

// Close database connection
mysqli_close($con);
?>
