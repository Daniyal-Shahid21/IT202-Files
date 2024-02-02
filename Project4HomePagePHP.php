<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>House Of Health</title>
	<link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">

	<audio id="alertAudio" autoplay="false">
  		<source src="alert_sound.mp3" type="audio/mpeg">
  		Your browser does not support this audio element.
	</audio>
	<audio id="yippeeAudio" autoplay="false">
  		<source src="yippee.mp3" type="audio/mpeg">
  		Your browser does not support this audio element.
	</audio>
</head>

<body>
	<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	   $first = $_POST["fname"];
	   $last = $_POST["lname"];
	   $pass = $_POST["pass"];
	   $id = $_POST["idnum"];
	   $phone = $_POST["phonum"];
	   $e = $_POST["email"];
	   $confirm = $_POST["confirm"];
	   $tran = $_POST["transaction"];
	   $servername = "sql1.njit.edu";
	   $username = "sds";
	   $password = "Pillowcase#1";
	   $dbname = "sds";
	   $con = mysqli_connect($servername, $username, $password, $dbname);
	   if (mysqli_connect_errno()) {
	      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	   }

	   $query = "SELECT `ReceptionistFirstName`, `ReceptionistLastName`,
	      `ReceptionistPassword`, `ReceptionistID`, `ReceptionistEmailAddress`
	      FROM Receptionist
	      WHERE `ReceptionistFirstName` = '$first' AND
	         `ReceptionistLastName` = '$last' AND
	         `ReceptionistPassword` = '$pass' AND
	         `ReceptionistID` = '$id' AND
	         `ReceptionistPhoneNumber` = '$phone'";
	   if ($confirm) {
	      $query .= " AND `ReceptionistEmailAddress` = '$e'";
	   }

	   $queryRun = mysqli_query($con, $query);
	   if (mysqli_num_rows($queryRun) > 0) {
	      $_SESSION["fname"] = $first;
	      $_SESSION["lname"] = $last;
	      $_SESSION["pass"] = $pass;
	      $_SESSION["idnum"] = $id;
	      $_SESSION["phonum"] = $phone;
	      $_SESSION["email"] = $e;
	      $_SESSION["confirm"] = $confirm;
	      $_SESSION["transaction"] = $tran;
	      header("Location: initredirect.php");
	      die;
	   } 
	   else {
	      echo '<script>alert("Receptionist data not found. Please re-enter and check inputted information is correct.")</script>';
	   }
	}
	mysqli_close($con);
	?>
	<h1>House of Health</h1>
	<form method="POST" action="Project4HomePagePHP.php" name="HoHSIPage" id="HoHForm">
		<div class="container">
			<div class="left_column">
				<label for="fname">Receptionist's First Name:</label>
				<label for="lname">Receptionist's Last Name:</label>
				<label for="pass">Receptionist's Password:</label>
				<label for="idnum">Receptionist's ID Number:</label>
				<label for="phonum">Receptionist's Phone #:</label>
				<label for="email">Receptionist's Email:</label>
				<span>Check the box to request an Email Confirmation:
  				<input class="left_button" type="checkbox" id="confirm" name="confirm" onclick="emailReq()"></span>
				<label for="emailreq" class ="movedown">Select a transaction:</label>
			</div>

			<div class="mid_column">
				<input type="text" id="fname" name="fname" placeholder="Example: Jane"><br>
				<input type="text" id="lname" name="lname" placeholder="Example: Doe"><br>
				<input type="password" id="pass" name="pass" placeholder="Example: DOC@1"><br>
				<input type="text" id="idnum" name="idnum" placeholder="Example: 4 digit number"><br>
				<input type="text" id="phonum" name="phonum" placeholder="Example: 551-254-5277"><br>
				<input type="text" id="email" name="email" placeholder="Example: ABC@gmail.com"><br>
				<select id="transaction" name="transaction">
					<option value="0" disabled selected>Select one of the following</option>
					<option value="1">Search A Receptionist’s Account</option>
					<option value="2">Update a Patient’s Record</option>
					<option value="3">Schedule An Appointment</option>
					<option value="4">Cancel an Appointment</option>
					<option value="5">Schedule A Procedure</option>
					<option value="6">Cancel a Procedure</option>
					<option value="7">Create A New Patient Account</option>
				</select>
			</div>

			<div class="right_column">
				<span>REQUIRED</span>
				<span>REQUIRED</span>
				<span>REQUIRED</span>
				<span>REQUIRED</span>
				<span>REQUIRED</span>
				<span id= "reqtext">REQUIRED</span>
				<span class= "buttons">
				<input type="submit" value="Submit">
				<button type="reset" name="resetButton" id="resetButton">Reset</button>
				</span>
			</div>
		</div>
	</form>
<script src="Project4AssignmentJS.js"></script>
</body>
</html>