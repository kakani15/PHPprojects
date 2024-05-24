<?php
// Enable error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve candidate ID from the form
    $candidate_id = $_POST['candidate_id'];

    // SQL query to get the candidate's role
    $role_query = "SELECT candidate_role FROM candidates WHERE candidate_id = '$candidate_id'";
    $role_result = mysqli_query($con, $role_query);

    if ($role_result && mysqli_num_rows($role_result) > 0) {
        $row = mysqli_fetch_assoc($role_result);
        $candidate_role = $row['candidate_role'];

        // Check if the user has already cast their vote
        $vote_count_column = "";
        if ($candidate_role == "MLA") {
            $vote_count_column = "vote_count_mla";
        } elseif ($candidate_role == "MP") {
            $vote_count_column = "vote_count_mp";
        }

        // Check the user's vote count
        $vote_count_query = "SELECT $vote_count_column FROM voters WHERE aadhar_card_number = '{$_SESSION['aadhar']}'";
        $vote_count_result = mysqli_query($con, $vote_count_query);
        $vote_count_row = mysqli_fetch_assoc($vote_count_result);
        $vote_count = $vote_count_row[$vote_count_column];

        if ($vote_count == 0) {
            // User has already cast their vote, redirect to voter_home_page.php
            echo "<script>alert('Thanks citizen ,you have already casted your vote for this candidate role');
            window.location.href = 'voter_home_page.php';</script>";
        } else {
            // User has not cast their vote yet, proceed to cast the vote
            // SQL query to increment the vote count for the selected candidate
            $update_query = "UPDATE candidates SET candidate_votes = candidate_votes + 1 WHERE candidate_id = '$candidate_id'";

            // Execute the query
            if (mysqli_query($con, $update_query)) {
                // Update the vote count for the particular voter
                $update_voter_query = "UPDATE voters SET $vote_count_column = 0 WHERE aadhar_card_number = '{$_SESSION['aadhar']}'";
                if (!mysqli_query($con, $update_voter_query)) {
                    echo "<div class='alert alert-danger' role='alert'>Error updating voter's vote count: " . mysqli_error($con) . "</div>";
                } else {
                    echo "<script>alert('Vote successfully casted.');
                    window.location.href = 'voter_home_page.php';</script>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error casting vote: " . mysqli_error($con) . "</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error retrieving candidate's role: " . mysqli_error($con) . "</div>";
    }
}

// Close database connection
mysqli_close($con);
?>
