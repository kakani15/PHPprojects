<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['aadhar'])) {
        // If not logged in, redirect to login page
        header("Location: Welcome_page.php");
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

    // Fetch constituencies
    $constituencies_query = "SELECT * FROM constituencies";
    $constituencies_result = $conn->query($constituencies_query);

    // Fetch assisting centers for selected constituency
    if (isset($_GET['constituency_id'])) {
        $constituency_id = $_GET['constituency_id'];
        $centers_query = "SELECT voting_assisting_center.center_id, 
                                voting_assisting_center.center_location, 
                                voting_assisting_center.center_importance_level, 
                                election_commission_employees.employee_name
                            FROM voting_assisting_center 
                            JOIN election_commission_employees 
                                ON voting_assisting_center.center_id = election_commission_employees.voting_assisting_center_id 
                            WHERE voting_assisting_center.center_constituency_id = $constituency_id";
        $centers_result = $conn->query($centers_query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assisting Centers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Saffron color for the sidebar and main content */
        .sidebar, .main-content {
            background-color: #FF9933;
        }

        /* Center tile styling */
        .center-tile {
            background-color: #FFD699; /* Lighter shade of saffron */
            border: 1px solid #FF9933; /* Border color same as saffron */
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Welcome to Assisting Centers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_home_page.php">Admin Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar with Constituency List -->
            <div class="col-lg-3 sidebar">
                <h2>Constituencies</h2>
                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for constituencies">
                <ul class="list-group" id="constituencyList">
                    <?php
                        if ($constituencies_result->num_rows > 0) {
                            while($row = $constituencies_result->fetch_assoc()) {
                                echo '<li class="list-group-item"><a href="?constituency_id='.$row["constituency_id"].'">'.$row["constituency_name"].'</a></li>';
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </ul>
            </div>
            <!-- Main Content Area to Display Assisting Centers -->
            <div class="col-lg-9 main-content">
                <?php
                    if (isset($centers_result) && $centers_result->num_rows > 0) {
                        echo '<h2>Assisting Centers</h2>';
                        while($row = $centers_result->fetch_assoc()) {
                            echo '<div class="card mb-3 center-tile">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Center ID: '.$row["center_id"].'</h5>';
                            echo '<p class="card-text">Location: '.$row["center_location"].'</p>';
                            echo '<p class="card-text">Importance Level: '.$row["center_importance_level"].'</p>';
                            echo '<p class="card-text">Incharge: '.$row["employee_name"].'</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No assisting centers found for selected constituency";
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        function searchFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("constituencyList");
            li = ul.getElementsByTagName('li');
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
