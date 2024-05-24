<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS for card style */
        .card {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #555;
        }

        body {
            background-image: url('https://www.shutterstock.com/shutterstock/videos/1096271163/thumb/11.jpg?ip=x480');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f9f9f9; /* Light grey background */
            font-family: 'Roboto', sans-serif; /* Professional font family */
            padding-top: 50px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-white mb-4">Contact Admin</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                // Database connection
                $servername = "localhost";
                $username = "nikhnara";
                $password = "pyre breaches warpaths inclined";
                $dbname = "nikhnara_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch admin details with constituency name and address
                $admin_query = "SELECT admin.*, constituencies.constituency_name, voting_assisting_center.center_location, election_commission_employees.employee_ph_no 
                                FROM admin 
                                JOIN election_commission_employees ON admin.employee_id = election_commission_employees.employee_id
                                JOIN constituencies ON election_commission_employees.constituency_id = constituencies.constituency_id
                                JOIN voting_assisting_center ON election_commission_employees.voting_assisting_center_id = voting_assisting_center.center_id";
                $admin_result = $conn->query($admin_query);

                if ($admin_result->num_rows > 0) {
                    while ($row = $admin_result->fetch_assoc()) {
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Name: " . $row["admin_name"] . "</h5>";
                        echo "<p class='card-text'><strong>Email:</strong> " . $row["email_id"] . "</p>";
                        echo "<p class='card-text'><strong>Phone:</strong> " . $row["employee_ph_no"] . "</p>";
                        echo "<p class='card-text'><strong>Address:</strong> " . $row["center_location"] . "</p>";
                        echo "<p class='card-text'><strong>Constituency:</strong> " . $row["constituency_name"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='text-white'>No admin details found.</p>";
                }

                // Close database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
