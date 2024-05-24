<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your CSS styles here */
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
</html>
    <div class="container">
        <h2>Add Employee Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name" required>
            </div>
            <div class="form-group">
                <label for="email_id">Email ID:</label>
                <input type="email" class="form-control" id="email_id" name="email_id" required>
            </div>
            <div class="form-group">
                <label for="district_incharge">District Incharge:</label>
                <select class="form-control" id="district_incharge" name="district_incharge" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <div class="form-group">
                <label for="employee_ph_no">Employee Phone Number:</label>
                <input type="tel" class="form-control" id="employee_ph_no" name="employee_ph_no" required>
            </div>
            <div class="form-group">
                <label for="is_admin">Is Admin:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" value="Yes">
                    <label class="form-check-label" for="is_admin">Yes</label>
                </div>
            </div>
            <div class="form-group">
                <label for="constituency_id">Constituency:</label>
                <select class="form-control" id="constituency_id" name="constituency_id" required>
                    <!-- Populate options dynamically from database -->
                    <?php
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

                        if ($constituencies_result->num_rows > 0) {
                            while($row = $constituencies_result->fetch_assoc()) {
                                echo '<option value="'.$row["constituency_id"].'">'.$row["constituency_name"].'</option>';
                            }
                        } else {
                            echo '<option value="">No constituencies found</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="voting_assisting_id">Voting Assisting Center:</label>
                <select class="form-control" id="voting_assisting_id" name="voting_assisting_id" required>
                    <!-- Populate options dynamically from database -->
                    <?php
                        // Fetch voting assisting centers
                        $centers_query = "SELECT * FROM voting_assisting_center";
                        $centers_result = $conn->query($centers_query);

                        if ($centers_result->num_rows > 0) {
                            while($row = $centers_result->fetch_assoc()) {
                                echo '<option value="'.$row["center_id"].'">'.$row["center_location"].'</option>';
                            }
                        } else {
                            echo '<option value="">No voting assisting centers found</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="aadhar_card_number">Aadhar Card Number:</label>
                <select class="form-control" id="aadhar_card_number" name="aadhar_card_number" required>
                    <!-- Populate options dynamically from database -->
                    <?php
                        // Fetch Aadhar card numbers
                        $aadhar_query = "SELECT aadhar_card_number FROM election_commission";
                        $aadhar_result = $conn->query($aadhar_query);

                        if ($aadhar_result->num_rows > 0) {
                            while($row = $aadhar_result->fetch_assoc()) {
                                echo '<option value="'.$row["aadhar_card_number"].'">'.$row["aadhar_card_number"].'</option>';
                            }
                        } else {
                            echo '<option value="">No Aadhar card numbers found</option>';
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
        
        <?php
        error_reporting(E_ALL);
ini_set('display_errors', 1);
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Connect to the database
            $con = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (mysqli_connect_errno()) {
                echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
                exit();
            }

            // Get form data
            $username = $_POST["username"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $employee_name = $_POST["employee_name"];
            $email_id = $_POST["email_id"];
            $district_incharge = $_POST["district_incharge"];
            $role = $_POST["role"];
            $employee_ph_no = $_POST["employee_ph_no"];
            $is_admin = isset($_POST["is_admin"]) ? $_POST["is_admin"] : "No";
            $constituency_id = $_POST["constituency_id"];
            $voting_assisting_id = $_POST["voting_assisting_id"];
            $aadhar_card_number = $_POST["aadhar_card_number"];

            // Insert data into database
            $insert_query = "INSERT INTO election_commission_employees (username, password, employee_name, email_id, district_incharge, role, employee_ph_no, is_admin, constituency_id, voting_assisting_center_id, aadhar_card_number) VALUES ('$username', '$hashed_password', '$employee_name', '$email_id', '$district_incharge', '$role', '$employee_ph_no', '$is_admin', '$constituency_id', '$voting_assisting_id', '$aadhar_card_number')";

            if (mysqli_query($con, $insert_query)) {
                echo "<p style='color: green;'>Employee details added successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error adding employee details: " . mysqli_error($con) . "</p>";
            }

            // Close database connection
            mysqli_close($con);
        }
        ?>
    </div>
</body>
</html>
