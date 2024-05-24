<?php
// Check if the logout button is clicked
if(isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: voter_login.html");
    exit();
}

// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['aadhar'])) {
    // Redirect to login page if user is not logged in
    header("Location: voter_login.html");
    exit();
}

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://www.shutterstock.com/shutterstock/videos/1096271163/thumb/11.jpg?ip=x480'); /* Add your background image URL here */
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f9f9f9; /* Light grey background */
            font-family: 'Roboto', sans-serif; /* Professional font family */
        }
        .container {
            max-width: 1200px;
            margin-top: 20px;
            padding-top: 50px;
            display: grid; /* Use grid layout for better control */
            grid-template-columns: 250px 1fr; /* Sidebar and main content */
            gap: 20px;
        }
        .sidebar {
            color: #fff;
            width: 200px; /* Narrower sidebar */
            padding-left: 20px;
            background-color: #007bff; /* Blue sidebar background */
            border-radius: 10px; /* Rounded corners */
        }
        .sidebar a {
            font-size: 14px; /* Larger font size */
            color: #fff;
            display: block;
            padding: 12px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #0056b3; /* Darker background on hover */
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 0;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            list-style-type: none;
        }
        .candidate-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .candidate-card:hover {
            transform: translateY(-5px);
        }
        .candidate-card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .candidate-details {
            padding: 20px;
        }
        .candidate-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .party-name {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }
        .candidate-role {
            font-size: 16px;
            color: #666;
        }
        .party-img {
            max-width: 60px; /* Reduce party image size */
            vertical-align: left; /* Align image vertically */
            margin-right: 5px; /* Add some space between party image and text */
        }
        .vote-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }
        .vote-btn:hover {
            background-color: #218838;
        }
        .btn-logout {
            /* Updated styles for logout button */
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            z-index: 99999; /* Ensure logout button is above other content */
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <aside>
            <h4 class="card-header">Voter Details</h4>
            <div class="card-body">
                <?php
                $aadhar = $_SESSION['aadhar'];
                $voter_query = "SELECT voters.voter_name, voters.voter_dob, voters.voter_address, voters.voter_emailID,constituencies.constituency_name,constituencies.constituency_district,election_commission.voter_id_number,voters.aadhar_card_number FROM voters JOIN election_commission on election_commission.aadhar_card_number=voters.aadhar_card_number JOIN constituencies ON constituencies.constituency_id=voters.voter_constituency_id WHERE voters.aadhar_card_number='$aadhar'";
                $voter_result = mysqli_query($con, $voter_query);
                $voter_row = mysqli_fetch_assoc($voter_result);

                echo "<p><strong>Name:</strong> " . $voter_row['voter_name'] . "</p>";
                echo "<p><strong>Date of Birth:</strong> " . $voter_row['voter_dob'] . "</p>";
                echo "<p><strong>Address:</strong> " . $voter_row['voter_address'] . "</p>";
                echo "<p><strong>Email ID:</strong> " . $voter_row['voter_emailID'] . "</p>";
                echo "<p><strong>Constituency:</strong> " . $voter_row['constituency_name'] . "</p>";
                echo "<p><strong>District:</strong> " . $voter_row['constituency_district'] . "</p>";
                echo "<p><strong>Voter ID Number:</strong> " . $voter_row['voter_id_number'] . "</p>";
                echo "<p><strong>Aadhar Card Number:</strong> " . $voter_row['aadhar_card_number'] . "</p>";
                ?>
            </div>
        </aside>
    </div>
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h3>Candidates in Your Constituency</h3>
            </div>
            <div class="card-body">
                <ul class="cards">
                    <?php
                    $aadhar = $_SESSION['aadhar'];
                    $sql = "SELECT candidates.candidate_id, 
       candidates.candidate_name, 
       candidates.candidate_role, 
       candidates.candidate_img, 
       parties.party_name, 
       parties.party_img
FROM voters 
JOIN constituencies ON voters.voter_district_id = constituencies.district_id AND voters.voter_constituency_id = constituencies.constituency_id
JOIN candidates ON 
  (CASE 
    WHEN candidates.candidate_role = 'MLA' THEN candidates.candidate_constituency_id = constituencies.constituency_id
    WHEN candidates.candidate_role = 'MP' THEN candidates.candidate_district_id = constituencies.district_id
  END)
JOIN parties ON parties.party_id = candidates.candidate_party_id
WHERE voters.aadhar_card_number = '$aadhar'";

                    $result = mysqli_query($con, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li class='candidate-card'>";
                            echo "<img src='" . $row['candidate_img'] . "' alt='" . $row['candidate_name'] . "' />";
                            echo "<div class='candidate-details'>";
                            echo "<h3 class='candidate-name'><a href='candidate.php?candidate_id=" . $row['candidate_id'] . "'>" . $row['candidate_name'] . "</a></h3>";
                            echo "<p class='party-name'><img src='" . $row['party_img'] . "' alt='Party Symbol' class='party-img' /> " . $row['party_name'] . " - <span class='candidate-role'>" . $row['candidate_role'] . "</span></p>";
                            echo "<form action='vote.php' method='post'>";
                            echo "<input type='hidden' name='candidate_id' value='" . $row['candidate_id'] . "'>";
                            echo "<button type='submit' class='vote-btn'>Vote</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li>No candidates found in your constituency.</li>";
                    }

                    // Close database connection
                    mysqli_close($con);
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<form method="post">
    <button type="submit" name="logout" class="btn btn-logout">Logout</button>
</form>
</body>
</html>
