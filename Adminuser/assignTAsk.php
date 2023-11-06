<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addedActivities"])) {
        // Get the addedActivities array from the POST data
        $addedActivities = $_POST["addedActivities"];

        // Get the last activityid from the database
        $sql = "SELECT MAX(activityid) AS maxActivityId FROM taskactivities";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lastActivityId = $row["maxActivityId"];

        // Initialize a variable to track insertion success
        $insertSuccess = true;

        // Start with the next activityid
        $nextActivityId = $lastActivityId + 1;

        foreach ($addedActivities as $data) {
            $Tid = $data["Tid"];
            $activity = $data["activity"];

            // Insert data into the database using the nextActivityId
            $sql = "INSERT INTO taskactivities (activityid, Tid, activity) VALUES ('$nextActivityId', '$Tid', '$activity')";
            if (!mysqli_query($conn, $sql)) {
                $insertSuccess = false;
                echo "Error inserting data: " . mysqli_error($conn);
                break; // Exit the loop on the first error
            }

            // Increment the nextActivityId for the next activity
            $nextActivityId++;
        }

        // Send a JSON response indicating success or failure
        if ($insertSuccess) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    }
}

mysqli_close($conn);
?>
