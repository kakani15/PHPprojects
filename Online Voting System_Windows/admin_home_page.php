<?php
    session_start();
    // Check if session is not set or Aadhar detail is not received, redirect to login page
    if (!isset($_SESSION['aadhar'])) {
        header("Location: admin.php"); // Change login.php to your actual login page
        exit();
    }
    
    // Database connection
    $servername = "localhost";
    $username = "nikhnara";
    $password = "pyre breaches warpaths inclined";
    $dbname = "nikhnara_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Logout logic
    if (isset($_POST['logout'])) {
        // Destroy the session
        session_unset();
        session_destroy();
        // Redirect to welcome page
        header("Location: Welcome_page.php"); // Change Welcome_page.php to your actual welcome page
        exit();
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('https://ichef.bbci.co.uk/news/976/cpsprodpb/40E3/production/_106311661_expander_index-03.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-color: #f5f5f5; /* Fallback color */
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            height: 100%;
            width: 250px;
            float: left;
        }

        .main-content-wrapper {
            float: right;
            width: calc(100% - 250px);
        }

        .list-group-item {
            background-color: #343a40;
            border: none;
            border-radius: 0;
        }

        .list-group-item:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
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

        .alert {
            margin-top: 20px;
        }

        .box {
            margin-bottom: 20px;
        }

        .tile {
            background-color: green;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .tile-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                float: none;
            }

            .main-content-wrapper {
                width: 100%;
                float: none;
                background-color: rgba(255, 255, 255, 0.8);
            }
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-text">Welcome to Admin Dashboard</span>
        <form class="form-inline ml-auto" method="post">
            <button class="btn btn-outline-warning logout-btn" type="submit" name="logout">Logout</button>
        </form>
    </nav>

    <aside class="sidebar">
        <div class="sidebar-heading">Admin Dashboard</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="candidate_results.php" class="text-white">View candidate results</a></li>
            <li class="list-group-item"><a href="add_candidate.php" class="text-white">Add candidates</a></li>
            <li class="list-group-item"><a href="add_voters.php" class="text-white">Add voter details</a></li>
            <li class="list-group-item"><a href="add_centers.php" class="text-white">Add assisting centers</a></li>
            <li class="list-group-item"><a href="assisting_centers.php" class="text-white">View Assisting centers</a></li>
            <li class="list-group-item"><a href="add_employees.php" class="text-white">Add employee details</a></li>
            <li class="list-group-item"><a href="employee_details.php" class="text-white">View employee details</a></li>
            <li class="list-group-item"><a href="add_constituencies.php" class="text-white">Add Constituency Details</a></li>
            <li class="list-group-item"><a href="admin_passwordchange.php" class="text-white">Change password</a></li>
        </ul>
    </aside>

    <div class="main-content-wrapper">

        <div class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="tile">
                        <div class="tile-title">Total Voters</div>
                        <div class="tile-value">
                            <?php
                                // Query to get the total number of voters
                                $query_voters = "SELECT COUNT(*) AS total_voters FROM voters";
                                $result_voters = mysqli_query($conn, $query_voters);
                                $row_voters = mysqli_fetch_assoc($result_voters);
                                $total_voters = $row_voters['total_voters'];
                                echo $total_voters;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile">
                        <div class="tile-title">Votes Casted</div>
                        <div class="tile-value">
                            <?php
                                // Query to get the total number of votes voted
                                $query_votes = "SELECT COUNT(*) AS total_votes FROM voters WHERE vote_count_mla = 0 OR vote_count_mp = 0";
                                $result_votes = mysqli_query($conn, $query_votes);
                                $row_votes = mysqli_fetch_assoc($result_votes);
                                $total_votes = $row_votes['total_votes'];
                                echo $total_votes;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile">
                        <div class="tile-title">Total Candidates</div>
                        <div class="tile-value">
                            <?php
                                // Query to get the total number of candidates
                                $query_candidates = "SELECT COUNT(*) AS total_candidates FROM candidates";
                                $result_candidates = mysqli_query($conn, $query_candidates);
                                $row_candidates = mysqli_fetch_assoc($result_candidates);
                                $total_candidates = $row_candidates['total_candidates'];
                                echo $total_candidates;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile">
                        <div class="tile-title">Total Parties</div>
                        <div class="tile-value">
                            <?php
                                // Query to get the total number of parties
                                $query_parties = "SELECT COUNT(*) AS total_parties FROM parties";
                                $result_parties = mysqli_query($conn, $query_parties);
                                $row_parties = mysqli_fetch_assoc($result_parties);
                                $total_parties = $row_parties['total_parties'];
                                echo $total_parties;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-light">
        <div class="container-fluid">
            <p class="text-muted text-center">Admin Dashboard &copy; <?php echo date("Y"); ?></p>
        </div>
    </footer>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
