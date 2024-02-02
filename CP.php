<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>House Of Health - Cancel Procedure</title>
   <link rel="stylesheet" type="text/css" href="Project4AssignmentCSS.css">
</head>

<body>
   <?php
   include "header.html";
   session_start();

   $con = mysqli_connect("sql1.njit.edu", "sds", "Pillowcase#1", "sds");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $procedureID = $_POST["procedureID"];

      // Check if the procedure exists
      $query = "SELECT ProcedureID FROM Procedures WHERE ProcedureID = '$procedureID'";
      $queryRun = mysqli_query($con, $query);

      if (mysqli_num_rows($queryRun) > 0) {
         // Confirm cancellation
         echo '<script>if(confirm("Are you sure you want to cancel the procedure?")) {
                     alert("Procedure canceled!");
                     window.location.href = "Project4HomePagePHP.php"; // Redirect to login or any other page
               }</script>';
      } 
      else {
         // Procedure does not exist
         echo '<script>alert("Procedure ID does not exist, please reenter.");</script>';
      }
   }
   ?>
   
   <h4 style="text-align:center;">Cancel Procedure</h4>
   <form method="POST" action="CP.php" name="CancelProcedureForm" id="CancelProcedureForm">
      <div class="container">
         <div class="left_column">
            <label for="procedureID">Procedure ID:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="procedureID" name="procedureID" placeholder="Enter Procedure ID"><br>
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
      form.addEventListener("submit", cancelProcedureConfirm);

      function validation(event) {
         let procedureID = document.forms["CancelProcedureForm"]["procedureID"].value;

         if (!/^\d{4}$/.test(procedureID)) {
            alert("Please enter a valid four-digit Procedure ID.");
            event.preventDefault();
            CancelProcedureForm.procedureID.focus();
            return false;
         }

         return true;
      }

      function cancelProcedureConfirm(event) {
         if (!validation()) {
            event.preventDefault();
            return false;
         }
      }
   </script>
</body>
</html>
