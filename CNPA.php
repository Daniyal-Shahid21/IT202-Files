<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health - Create New Patient Account</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
<?php
include "header.html";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $patientID = $_POST["patientID"];
   $patientFirstName = $_POST["patientFirstName"];
   $patientLastName = $_POST["patientLastName"];
   $receptionistID = $_SESSION["idnum"]; // Retrieve receptionistID from the session

   // Check if the required fields are not empty
   if (!empty($patientID) && !empty($patientFirstName) && !empty($patientLastName) && !empty($receptionistID)) {
      // Regular expression for patient ID validation
      $patientIDRegex = '/^\d{3}[A-Z]$/';

      // Check if the patient ID meets the validation rules
      if (preg_match($patientIDRegex, $patientID)) {
         // Database connection details
         $servername = "sql1.njit.edu";
         $username = "sds";
         $password = "Pillowcase#1";
         $dbname = "sds";

         $con = mysqli_connect($servername, $username, $password, $dbname);
         if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
         }

         // Check if the patient exists
         $query = "SELECT * FROM Patients WHERE PatientID = '$patientID'";
         $queryRun = mysqli_query($con, $query);

         if (mysqli_num_rows($queryRun) > 0) {
            // Patient already exists
            echo '<script>alert("Patient already exists in the system.");</script>';
         } else {
            // Insert the new patient into the Patients table
            $insertQuery = "INSERT INTO Patients (ReceptionistID, PatientID, PatientFirstName, PatientLastName)
                            VALUES ('$receptionistID', '$patientID', '$patientFirstName', '$patientLastName')";
            $insertRun = mysqli_query($con, $insertQuery);

            if ($insertRun) {
               // Patient successfully added
               echo '<script>alert("New patient added successfully!");</script>';
            } else {
               // Error in adding patient
               echo '<script>alert("Error adding patient. Please try again.");</script>';
            }
         }
      } else {
         // Validation rules not met
         echo '<script>alert("Please enter a valid Patient ID with 1 capital letter followed by 3 numbers.");</script>';
      }
   } 
   else {
      // Fields are empty
      echo '<script>alert("Please fill in all the required fields.");</script>';
   }
   mysqli_close($con);
}
?>

   <h4 style="text-align:center;">Create New Patient Account</h4>
   <form method="POST" action="CNPA.php" name="CreatePatientForm" id="CreatePatientForm">
      <div class="container">
         <div class="left_column">
            <label for="patientID">Patient ID:</label><br>
            <label for="patientFirstName">First Name:</label><br>
            <label for="patientLastName">Last Name:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="patientID" name="patientID" placeholder="Enter Patient ID"><br>
            <input type="text" id="patientFirstName" name="patientFirstName" placeholder="Enter First Name"><br>
            <input type="text" id="patientLastName" name="patientLastName" placeholder="Enter Last Name"><br>
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

   <script>
      let form = document.querySelector("form");
      form.addEventListener("submit", createPatientConfirm);
      
      function createPatientConfirm(event) {
         let patientID = document.forms["CreatePatientForm"]["patientID"].value;
         let patientIDRegex = /^\d{3}[A-Z]$/;

         // Check if the patient ID meets the validation rules
         if (!patientIDRegex.test(patientID)) {
            alert("Please enter a valid Patient ID with 1 capital letter followed by 3 numbers.");
            event.preventDefault();
            CreatePatientForm.patientID.focus();
         }
      }
   </script>
</body>
</html>