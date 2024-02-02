<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
   <?php
   include "header.html";
   session_start();

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $id = $_POST["idnum"];

      // Database connection details
      $servername = "sql1.njit.edu";
      $username = "sds";
      $password = "Pillowcase#1";
      $dbname = "sds";

      $con = mysqli_connect($servername, $username, $password, $dbname);
      if (mysqli_connect_errno()) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
         exit();
      }

      // Check if the patient exists
      $query = "SELECT `PatientID`
                FROM Patients
                WHERE `PatientID` = '$id' AND `PatientFirstName` = '$fname' AND `PatientLastName` = '$lname'";

      $queryRun = mysqli_query($con, $query);

      if (mysqli_num_rows($queryRun) > 0) {
         // Redirect to the appointment creation form
         $_SESSION["idnum"] = $id; // Store patientID in the session
         header("Location: SARedirect.php");
         exit();
      } 
      else {
         // Patient not found, show alert and redirect to create a new patient account
         $_SESSION["transaction"] = "7";
         echo '<script>alert("Patient cannot be found. You will be redirected. Create an account for the patient so a secondary check can occur.");
         window.location.href = "initredirect.php";</script>';
      die;
         exit();
      }
   }
   mysqli_close($con);
   ?>
   <h4 style = "text-align:center;">Confirm Patient Status</h4>
   <form method="POST" action="SA.php" name="AuthForm" id="AuthForm">
      <div class="container">
         <div class="left_column">
            <label for="fname">First Name:</label><br>
            <label for="lname">Last Name:</label><br>
            <label for="idnum">Patient's ID:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="fname" name="fname" placeholder="Enter First Name"><br>
            <input type="text" id="lname" name="lname" placeholder="Enter Last Name"><br>
            <input type="text" id="idnum" name="idnum" placeholder="Enter Patient ID"><br>
         </div>

         <div class="right_column">
            <span>REQUIRED</span>
            <span>REQUIRED</span>
            <span>REQUIRED</span>
            <span class="buttons">
               <input type="submit" value="Submit">
               <button type="reset" name="resetButton" id="resetButton" style="color: black;">Reset</button>
            </span>
         </div>
      </div>
   </form>
</body>
</html>