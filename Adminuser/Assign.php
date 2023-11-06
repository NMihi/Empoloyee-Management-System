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
  $Eid=$_POST["Eid"];
  $Tid=$_POST["Tid"];
  $dateassign=$_POST["dateassign"];
  $activityid=$_POST["activityid"];
  $remarks=$_POST["remarks"];

  $sql= "INSERT INTO assign VALUES('$Eid','$Tid','$dateassign','$activityid','$remarks')";

  if (mysqli_query($conn, $sql)) {
    $message = "Form submitted successfully!";
    // Redirect back to the empReg.html page with the message as a query parameter
    header("Location: assignEmp.php?message=" . urlencode($message));
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

mysqli_close($conn);
?>
