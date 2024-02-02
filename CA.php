<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health - Cancel Appointment</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
   <?php
   include "header.html";
   session_start();

   $con = mysqli_connect("sql1.njit.edu", "sds", "Pillowcase#1", "sds");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $appointmentID = $_POST["appointmentID"];

      // Check if the appointment exists
      $query = "SELECT AppointmentID FROM Appointments WHERE AppointmentID = '$appointmentID'";
      $queryRun = mysqli_query($con, $query);

      if (mysqli_num_rows($queryRun) > 0) {
         // Confirm cancellation
         echo '<script>confirm("Are you sure you wanna cancel Big Boy?");</script>';

            // Delete the appointment from the Appointments table
         $deleteQuery = "DELETE FROM Appointments WHERE AppointmentID = '$appointmentID'";
         $deleteRun = mysqli_query($con, $deleteQuery);

         if ($deleteRun) {
            // Appointment successfully canceled
            echo '<script>alert("Appointment Canceled!");</script>';
         } 
         else {
            // Error in canceling appointment
            echo '<script>alert("Error canceling appointment. Please try again.");</script>';
            }
         }

      } 
      else {
         // Appointment does not exist
         echo '<script>alert("Appointment ID does not exist, please reenter.");</script>';
      }
   ?>
   
   <h4 style="text-align:center;">Cancel Appointment</h4>
   <form method="POST" action="CA.php" name="CancelAppointmentForm" id="CancelAppointmentForm">
      <div class="container">
         <div class="left_column">
            <label for="appointmentID">Appointment ID:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="appointmentID" name="appointmentID" placeholder="Enter Appointment ID"><br>
         </div>

         <div class="right_column">
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
      form.addEventListener("submit", cancelAppointmentConfirm);

      function validation(event) {
         let appointmentID = document.forms["CancelAppointmentForm"]["appointmentID"].value;

         if (!/^\d{3}$/.test(appointmentID)) {
            alert("Please enter a valid three-digit Appointment ID.");
            event.preventDefault();
            CancelAppointmentForm.appointmentID.focus();
            return false;
         }

         return true;
      }

      function cancelAppointmentConfirm(event) {
         if (!validation()) {
            event.preventDefault();
            return false;
         }
      }
   </script>
</body>
</html>