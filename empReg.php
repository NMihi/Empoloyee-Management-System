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
  $telephone=$_POST["telephone"];
  $Name=$_POST["Name"];
  $email=$_POST["email"];
  $Designation=$_POST["Designation"];
  $usertype=$_POST["usertype"];
  $password=$_POST['password'];

// Hash the password before storing it in the database
// $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  $sql= "INSERT INTO employee VALUES('$Eid','$telephone','$Name','$email','$Designation','$usertype','$password')";

  if (mysqli_query($conn, $sql)) {
    $message = "Form submitted successfully!";
    // Redirect back to the empReg.html page with the message as a query parameter
    header("Location: empReg.html?message=" . urlencode($message));
    exit;

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

mysqli_close($conn);
?>

