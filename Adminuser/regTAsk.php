<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "project";

  $conn = mysqli_connect($servername,$username,$password,$database);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

  $Tid=$_POST["Tid"];
  $Name=$_POST["Name"];
  $StartDate=$_POST["StartDate"];
  $EndDate=$_POST["EndDate"];
  $nature=$_POST["nature"];

  $sql= "INSERT INTO task VALUES('$Tid','$Name','$StartDate','$EndDate','$nature')";

  if (mysqli_query($conn, $sql)) {
    $message = "Form submitted successfully!";
    // Redirect back to the emp.html page with the message as a query parameter
    header("Location: task.html?message=" . urlencode($message));
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

mysqli_close($conn);
?>
