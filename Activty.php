<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$addedActivities = []; // Initialize an empty array to store added activities

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // If the "Add" button is clicked, add the data to the array
        $Tid = $_POST["Tid"];
        $activity = $_POST["activity"];
        
        // Add the data to the $addedActivities array
        $addedActivities[] = array(
            "Tid" => $Tid,
            "activity" => $activity,
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
<aside>
<div class="toggle">
          <div class="close" id="close-btn">
            <span class="material-icons-sharp"> close </span>
          </div>
        </div>
        <div class="sidebar">
          <a href="empReg.html">
            <span class="material-icons-sharp"> person </span>
            <h3>Employee</h3>
          </a>
          <a href="Task.html">
            <span class="material-icons-sharp"> task </span>
            <h3>Task</h3>
          </a>
          <a href="Activty.php" class="active">
            <span class="material-icons-sharp"> add_task </span>
            <h3>Activity</h3>
          </a>
          <a href="assignEmp.php">
            <span class="material-icons-sharp"> assignment_ind </span>
            <h3>Assign Task</h3>
          </a>
          <a href="ViewTasks.php">
            <span class="material-icons-sharp"> tab </span>
            <h3>Employee Task</h3>
          </a>
          <a href="Report.php" class="active">
            <span class="material-icons-sharp"> report </span>
            <h3>Report</h3>
          </a>
          <a href="SignUp.html">
            <span class="material-icons-sharp"> logout </span>
            <h3>Log out</h3>
          </a>
        </div>
      </aside>
      <main>
      <center>
      <div class="recent-orders red">
      <h1>Activities</h1>
      </div>
        <div class="recent-orders top-table">
        <div class="d-flex justify-content-center">
            <form id="activity-form" action="assginTAsk.php" method="POST">
                <center><h2>Add activities</h2></center>
                <table class="form-table ds-remove">
                    <tr>
                        <td class="form-label">Task  </td>
                        <td>
                            <select name="Tid" id="Tid" class="form-control" required>
                            <option value="disabled selected hidden" >Select task</option>
                                <?php
                                // Populate the dropdown with Task IDs from the database
                                $sql = "SELECT Tid,Name FROM task";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["Tid"] . "'>" . $row["Name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="form-label">Activity  </td>
                        <td><input type="text" name="activity" class="form-control" required/></td>
                    </tr>
                </table>
                <button type="button" name="add" id="add" class="btn btn-success">Add</button>
            </form>
        </div>
        </div>
        <br><br>
            <div class="recent-orders bottom-table">
                <table class="table ds-remove">
                    <thead class="mx-auto">
                        <tr>
                            <th>Task ID</th>
                            <th>Activity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="activity-table-body" class="mx-auto">
                    </tbody>
                </table>
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </center>
    </main>
    <div class="right-section">
    <div class="nav">
        <button id="menu-btn">
        <span class="material-icons-sharp"> menu </span>
        </button>
    </div>
</div>

<script>
$(document).ready(function () {
    var addedActivities = []; // Initialize an empty array in JavaScript

    // Handle the "Add" button click using JavaScript
    $("#add").click(function () {
        var Tid = $("#Tid").val();
        var activity = $("input[name='activity']").val();

        // Create a new activity object with a manually specified activityid
        var newActivity = {
            "Tid": Tid,
            "activity": activity
        };

        // Add the new activity to the addedActivities array
        addedActivities.push(newActivity);

        // Clear the input field
        $("input[name='activity']").val("");

        // Refresh the table with the updated data
        refreshTable();
    });

    // Function to refresh the table with added data
    function refreshTable() {
        var tableBody = $("#activity-table-body"); // Get the table body
        tableBody.empty(); // Clear the table body

        // Loop through addedActivities and append rows to the table body
        for (var i = 0; i < addedActivities.length; i++) {
            var data = addedActivities[i];
            var row = "<tr><td>" + data.Tid + "</td><td>" + data.activity + "</td><td><button  class='btn btn-danger delete-btn' data-index='" + i + "'>Delete</button></td></tr>";
            tableBody.append(row);
        }

        //add delete button
        $(".delete-btn").click(function () {
            var index = $(this).data("index");
            addedActivities.splice(index, 1); // Remove the item from the array
            refreshTable(); // Refresh the table to reflect the changes
        });
    }

    // Handle the form submission
    $("#submit").click(function () {
        $.ajax({
            type: "POST",
            url: "assignTAsk.php",
            data: { "addedActivities": addedActivities },
            success: function (response) {
                // Handle the response from the server 
                if (response === "success") {
                    alert("Data submitted successfully!");
                    // Clear the addedActivities array and refresh the table
                    addedActivities = [];
                    refreshTable();
                } else {
                  alert("Data submitted successfully!");
                    // Clear the addedActivities array and refresh the table
                    addedActivities = [];
                    refreshTable();

                    // alert("Error: " + response);
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
                alert("AJAX Error: " + error);
            }
        });
    });
});

</script>
<script src="index.js"></script>
</body>
</html>