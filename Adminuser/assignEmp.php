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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="style.css" />
    <title>Project</title>

  </head>

  <body>
    <div class="container">
      <!-- Sidebar Section -->
      <aside>
      <div class="toggle">
          <div class="close" id="close-btn">
            <span class="material-icons-sharp"> close </span>
          </div>
        </div>
        <div class="sidebar">
          <!-- <a href="empReg.html">
            <span class="material-icons-sharp"> person </span>
            <h3>Employee</h3>
          </a> -->
          <a href="Task.html">
            <span class="material-icons-sharp"> task </span>
            <h3>Task</h3>
          </a>
          <a href="Activity.php">
            <span class="material-icons-sharp"> add_task </span>
            <h3>Activity</h3>
          </a>
          <a href="assignEmp.php" class="active">
            <span class="material-icons-sharp"> assignment_ind </span>
            <h3>Assign Task</h3>
          </a>
          <a href="/nirmalproj/ViewTasks.php">
            <span class="material-icons-sharp"> tab </span>
            <h3>Employee Task</h3>
          </a>
          <a href="Report.php" class="active">
            <span class="material-icons-sharp"> report </span>
            <h3>Report</h3>
          </a>
          <a href="/nirmalproj/SignUp.html">
            <span class="material-icons-sharp"> logout </span>
            <h3>Log out</h3>
          </a>
        </div>
      </aside>
      <!-- End of Sidebar Section -->

      <!-- Main Content -->
      <main>
      <div class="recent-orders red">
        <center><h1>Assign Task</h1></center>
        </div>

        <div class="recent-orders top-table">
          <div class="d-flex justify-content-center">
          <form id="activity-form" action="Assign.php" method="POST">
        <center><h2>Assign tasks to employees</h2></center>
        <table class="form-table ds-remove">
        <tr>
                <td class="form-label">Employee</td>
                <td>
                    <select name="Eid" id="Eid" class="form-control" required>
                    <option value="" disabled selected hidden>Select employee</option>
                        <?php
                        // Populate the dropdown with Task IDs from the database
                        $sql = "SELECT Eid,Name FROM employee";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["Eid"] . "'>" . $row["Name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">Task</td>
                <td>
                    <select name="Tid" id="Tid" class="form-control" required>
                    <option value="" disabled selected hidden>Select task</option>
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
            <td class="form-label"> Date Assigned </td>
            <td><input type="date" name="dateassign" id="dateassign" class="form-control" required></td>
            </tr>
            <tr>
                <td class="form-label">Activity</td>
                <td>
                    <select name="activityid" id="activityid" class="form-control" required>
                    <option value="" disabled selected hidden>Select activity</option>
                        <?php
                        // Populate the dropdown with Task IDs from the database
                        $sql = "SELECT activityid,activity FROM taskactivities";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["activityid"] . "'>" . $row["activity"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">remarks</td>
                <td><input type="text" name="remarks" class="form-control" td>
            </tr>
        </table>
        <button type="submit" name="sub" id="sub" class="btn btn-primary">Submit</button>
    </form>
          </div>
        </div>
        <!-- End of Recent Orders -->
      </main>
      <!-- End of Main Content -->
      <div class="right-section">
        <div class="nav">
          <button id="menu-btn">
            <span class="material-icons-sharp"> menu </span>
          </button>
        </div>
    </div>

    <script>
      // Function to get the value of a query parameter by name
      function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
      }

      // Get the message query parameter
      const message = getQueryParam("message");

      // Display the alert if a message is present
      if (message) {
        alert(message);
      }
    </script>
    <script src="index.js"></script>
  </body>
</html>
