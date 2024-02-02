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
      $shots = $_POST["shots"];
      $ill = $_POST["illness"];
      $id = $_POST["idnum"];
      $servername = "sql1.njit.edu";
      $username = "sds";
      $password = "Pillowcase#1";
      $dbname = "sds";
      $con = mysqli_connect($servername, $username, $password, $dbname);
      if (mysqli_connect_errno()) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      echo "<link rel='stylesheet' href='Pages.css'>";

      $query = "SELECT `PatientID`
                FROM Patients
                WHERE `PatientID` = '$id'";

      $queryRun = mysqli_query($con, $query);
      if (mysqli_num_rows($queryRun) > 0) {
         echo '<script>alert("Patient Identified");</script>';
      }

      if (mysqli_num_rows($queryRun) > 0) {
         echo '<script>alert("Shots and Illnesses Updated");</script>';
         $_SESSION["idnum"] = $id;
         $_SESSION["shots"] = $shots;
         $_SESSION["illness"] = $ill;
         $query2 = "UPDATE `Records` 
                    SET `ShotsGiven`= '$shots',`Illnesses`= '$ill'
                    WHERE `PatientID`= '$id'";
         $queryRun = mysqli_query($con, $query2);
      } 
      else {
         echo '<script>alert("Patient was not found, please reenter Patient ID"); 
            </script>';

      }

   }
   mysqli_close($con);
   ?>
   <h4 style = "text-align:center;">Update Patient Records</h4>
   <form method="POST" action="UPR.php" name="UPRPage" id="UPRForm">
      <div class="container">
         <div class="left_column">
            <label for="shots">New Shots:</label><br>
            <label for="illness">New Illnesses:</label><br>
            <label for="idnum">Patient's ID:</label><br>
         </div>

         <div class="mid_column">
            <input type="text" id="shots" name="shots" placeholder="Example: Covid"><br>
            <input type="text" id="illness" name="illness" placeholder="Example: Flu"><br>
            <input type="text" id="idnum" name="idnum" placeholder="Example: 1234"><br>
         </div>

         <div class="right_column">
            <span>REQUIRED</span>
            <span>REQUIRED</span>
            <span>REQUIRED</span>
            <span class= "buttons">
            <input type="submit" value="Submit">
            <button type="reset" name="resetButton" id="resetButton" style = "color: black;">Reset</button>
            </span>
         </div>
      </div>
   </form>
<script>
   let form = document.querySelector("form");
   form.addEventListener("submit", UPRConfirm);
   function validation(event) {
   let shotval = document.forms["UPRPage"]["shots"].value;
   let illval = document.forms["UPRPage"]["illness"].value;
   let idval = document.forms["UPRPage"]["idnum"].value;

   var idre = /^[a-zA-Z\d]{4}$/;

   if (idval == "") {
      alert("The data entered for Patient ID is incorrect. Please check your data");
      event.preventDefault();
      UPRForm.idnum.focus();
      return false;
   } 
   else if (!idre.test(idval)) {
      alert("The data entered for Patient ID is incorrect. Please check your data");
      event.preventDefault();
      UPRForm.idnum.focus();
      return false;
   }
   return true;
}

   function UPRConfirm(event) {
      if (!validation()) {
         event.preventDefault();
         return false;
      }
      let confirmed = confirm("You are about to UPDATE the shots and illness for the patient. Are you sure you want to do so?");
      if (!confirmed) {
         event.preventDefault();
      }
   }
</script>
</body>
</html>