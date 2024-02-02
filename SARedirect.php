<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health - Appointment Form</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
   <?php
include "header.html";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentType = $_POST["appointmentType"];
    $appointmentDate = $_POST["appointmentDate"];
    $patientID = $_SESSION["idnum"]; // Retrieve patientID from the session
    $doctorID = $_POST["doctorID"]; // Retrieve doctorID from the form

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

    // Generate a random 3-digit appointment ID
    $appointmentID = rand(100, 999);

    // Insert the new appointment into the Appointments table
    $query = "INSERT INTO Appointments (AppointmentID, PatientID, DoctorID, AppointmentType, AppointmentDate)
              VALUES ('$appointmentID', '$patientID', '$doctorID', '$appointmentType', '$appointmentDate')";

    $queryRun = mysqli_query($con, $query);

    if ($queryRun) {
        // Appointment successfully scheduled
        echo '<script>alert("Appointment Confirmed! Your Appointment ID is ' . $appointmentID . '");</script>';

        if (strpos(strtolower($appointmentType), 'procedure') !== false) {
            // Insert into Procedures table if it's a procedure
            $procedureQuery = "INSERT INTO Procedures (AppointmentID) VALUES ('$appointmentID')";
            mysqli_query($con, $procedureQuery);
        }

        // Redirect logic
        $_SESSION["transaction"] = "5";
        echo '<script>alert("If you wish to schedule an appointment regarding a procedure, please additionally schedule an appointment");
              window.location.href = "initredirect.php";</script>';
    } else {
        // Error in appointment scheduling
        echo '<script>alert("Error scheduling appointment. Please try again.");</script>';
    }
}
mysqli_close($con);
?>

   <h4 style = "text-align:center;">Appointment Form</h4>
   <form method="POST" action="SARedirect.php" name="AppointmentForm" id="AppointmentForm">
      <div class="container">
         <div class="left_column">
            <label for="appointmentType">Appointment Type:</label><br>
            <label for="appointmentDate">Appointment Date:</label><br>
            <label for="doctorID">Doctor ID:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="appointmentType" name="appointmentType" placeholder="Enter Appointment Type"><br>
            <input type="date" id="appointmentDate" name="appointmentDate"><br>
            <input type="text" id="doctorID" name="doctorID" placeholder="Enter Doctor ID"><br>
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
      form.addEventListener("submit", appointmentConfirm);

      function generateRandomAppointmentID() {
         return Math.floor(Math.random() * (999 - 100 + 1)) + 100;
      }

      function validation(event) {
         let appointmentType = document.forms["AppointmentForm"]["appointmentType"].value;
         let appointmentDate = document.forms["AppointmentForm"]["appointmentDate"].value;
         let doctorID = document.forms["AppointmentForm"]["doctorID"].value;

         if (appointmentType === "") {
            alert("Please enter the appointment type.");
            event.preventDefault();
            AppointmentForm.appointmentType.focus();
            return false;
         }

         if (appointmentDate === "") {
            alert("Please enter the appointment date.");
            event.preventDefault();
            AppointmentForm.appointmentDate.focus();
            return false;
         }

         if (doctorID === "") {
            alert("Please enter the doctor ID.");
            event.preventDefault();
            AppointmentForm.doctorID.focus();
            return false;
         }

         return true;
      }

      function appointmentConfirm(event) {
         if (!validation()) {
            event.preventDefault();
            return false;
         }

         let confirmed = confirm("You are about to schedule an appointment. Are you sure you want to do so?");
         if (!confirmed) {
            event.preventDefault();
         }
      }
   </script>
</body>
</html>