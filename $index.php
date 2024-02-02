<body>
<?php
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$con = mysqli_connect($servername,$username,$password,$dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  $studId = $_POST["idVar"];
  $sql = "SELECT ID FROM Student WHERE ID=".$studId;
  $product = $con->query($sql);
  
  
  if($product->num_rows != 0) {
    $_SESSION["studentId"] = $studId;
    header("Location: HW11AssignmentPHP.php");
    die;
  }
  else {
    echo '<script>window.alert("ID not in database. Re-enter")</script>';
  }
}
?>

<form method="post" action="HW11Assignment.php">
  <label for="idVar">Student ID</label>  
  <input type="text" name="idVar" id="idVar"><br>
  <button type="submit" name="sub">Submit</button>
</form>
</body>