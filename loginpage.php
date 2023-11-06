<?php
// Connect to the database (you will need to replace these with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to find the user
$sql = "SELECT * FROM login WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Verify the password using password_verify
    if (password_verify($password, $row['password'])) {
        // Successful login, start a session or create a token and redirect
        // You can also set user information in the session for future use
        session_start();
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirect to the dashboard
    } else {
        echo "Incorrect password. <a href='SignUp.html'>Try again</a>";
    }
} else {
    echo "User not found. <a href='SignUp.html'>Try again</a>";
}

$conn->close();
?>
