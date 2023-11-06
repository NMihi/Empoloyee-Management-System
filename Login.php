<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to fetch user data
    $sql = "SELECT Eid, email, usertype FROM employee WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $Eid, $email, $usertype);

            if (mysqli_stmt_fetch($stmt)) {
                // Start a new session
                session_start();

                // Store user information in session variables
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = $usertype;
                $_SESSION['Eid']=$Eid;

                // Successful login, redirect based on UserType
                if ($usertype == "superadmin") {
                    header("Location: empReg.html");
                } elseif ($usertype == "admin") {
                    header("Location: Adminuser/Task.html");
                } elseif ($usertype == "employee") {
                    header("Location: ViewTasks.php");
                } else {
                    // Handle unknown UserType
                    echo "Unknown user type.";
                }
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error in prepared statement: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
