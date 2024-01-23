<?php
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$con = mysqli_connect($servername,$username,$password,$dbname);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
	echo "CONNECTED ";
}
?>