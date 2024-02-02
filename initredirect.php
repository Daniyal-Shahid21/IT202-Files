<?php
session_start();
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#2";
$dbname = "sds";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$tran = $_SESSION["transaction"];
switch ($tran) {
   case "1":
      header("Location: SRA.php");
      break;
   case "2":
      header("Location: UPR.php");
      break;
   case "3":
      header("Location: SA.php");
      break;
   case "4":
      header("Location: CA.php");
      break;
   case "5":
      header("Location: SP.php");
      break;
   case "6":
      header("Location: CP.php");
      break;
   case "7":
      header("Location: CNPA.php");
      break;
}
mysqli_close($con);
?>