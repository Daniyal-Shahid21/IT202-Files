<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health - Schedule Procedure</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
   <?php
   include "header.html";
   session_start();

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $appointmentID = $_POST["appointmentID"];
      $procedureDate = $_POST["procedureDate"];
      $procedureType = $_POST["procedureType"];

      // Database connection details
      $servername = "sql1.njit.edu";
      $username = "sds";
      $password = "Pillowcase#1";
      $dbname = "sds";

      $con = mysqli_connect($servername, $username, $password, $dbname);
      if (mysqli_connect_errno()) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      echo "<link rel='stylesheet' href='Pages.css'>";

      // Check if the appointment exists
      $query = "SELECT PatientID, AppointmentType FROM Appointments WHERE AppointmentID = '$appointmentID'";
      $queryRun = mysqli_query($con, $query);

      if (mysqli_num_rows($queryRun) > 0) {
         // Fetch the appointment details
         $row = mysqli_fetch_assoc($queryRun);
         $patientID = $row["PatientID"];
         $appointmentType = $row["AppointmentType"];

         // Check if the appointment type contains the word "procedure"
         if (strpos(strtolower($appointmentType), 'procedure') === false) {
            // Redirect logic
            $_SESSION["transaction"] = "3";
            echo '<script>alert("If you wish to schedule a procedure, please schedule an appointment needing a procedure");
                  window.location.href = "initredirect.php";</script>';
         } 
         else {
            // Generate a random 4-digit procedure ID
            $procedureID = rand(1000, 9999);

            // Insert the new procedure into the Procedures table
            $insertQuery = "INSERT INTO Procedures (ProcedureID, PatientID, ProcedureType, ProcedureDate)
                            VALUES ('$procedureID', '$patientID', '$procedureType', '$procedureDate')";
            $insertRun = mysqli_query($con, $insertQuery);

            if ($insertRun) {
               // Procedure successfully scheduled
               echo '<script>alert("Procedure Scheduled! Your Procedure ID is ' . $procedureID . '");</script>';
            } else {
               // Error in scheduling procedure
               echo '<script>alert("Error scheduling procedure. Please try again.");</script>';
            }
         }
      } else {
         // Appointment does not exist
         echo '<script>alert("Appointment ID does not exist, please reenter.");</script>';
      }
   }
   mysqli_close($con);
   ?>

   <h4 style="text-align:center;">Schedule Procedure</h4>
   <form method="POST" action="SP.php" name="ProcedureForm" id="ProcedureForm">
      <div class="container">
         <div class="left_column">
            <label for="appointmentID">Appointment ID:</label><br>
            <label for="procedureDate">Procedure Date:</label><br>
            <label for="procedureType">Procedure Type:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="appointmentID" name="appointmentID" placeholder="Enter Appointment ID"><br>
            <input type="date" id="procedureDate" name="procedureDate"><br>
            <input type="text" id="procedureType" name="procedureType" placeholder="Enter Procedure Type"><br>
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
      form.addEventListener("submit", scheduleProcedureConfirm);

      function validation(event) {
         let appointmentID = document.forms["ProcedureForm"]["appointmentID"].value;

         if (!/^\d{3}$/.test(appointmentID)) {
            alert("Please enter a valid three-digit Appointment ID.");
            event.preventDefault();
            ProcedureForm.appointmentID.focus();
            return false;
         }

         return true;
      }

      function scheduleProcedureConfirm(event) {
         if (!validation()) {
            event.preventDefault();
            return false;
         }
      }
   </script>
</body>
</html>
