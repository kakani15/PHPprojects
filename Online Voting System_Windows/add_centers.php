<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voting Assisting Center</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Voting Assisting Center</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="center_constituency_id">Constituency</label>
                <select id="center_constituency_id" name="center_constituency_id" class="form-control" required>
                    <!-- Options dynamically populated from the database -->
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

                    // Close database connection
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="center_location">Center Location</label>
                <input type="text" id="center_location" name="center_location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="center_importance_level">Center Importance Level</label>
                <select id="center_importance_level" name="center_importance_level" class="form-control" required>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Center</button>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
        
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get form data
            $constituency_id = $_POST["center_constituency_id"];
            $center_location = $_POST["center_location"];
            $center_importance_level = $_POST["center_importance_level"];

            // Insert data into database
            $insert_query = "INSERT INTO voting_assisting_center (center_constituency_id, center_location, center_importance_level) VALUES ('$constituency_id', '$center_location', '$center_importance_level')";

            if ($conn->query($insert_query) === TRUE) {
                echo "<p style='color: green;'>New center added successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error: " . $insert_query . "<br>" . $conn->error . "</p>";
            }

            // Close database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
