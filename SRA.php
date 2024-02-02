<?php
session_start();
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = $_SESSION["idnum"];
echo "<link rel='stylesheet' href='Pages.css'>";
include "header.html";
$query = "SELECT Receptionist.`ReceptionistFirstName`,
   Receptionist.`ReceptionistLastName`,  
   Receptionist.`ReceptionistID`,
   Receptionist.`ReceptionistPhoneNumber`,
   Receptionist.`ReceptionistEmailAddress`,
   Patients.`PatientFirstName`, 
   Patients.`PatientLastName`, 
   Patients.`PatientID`, 
   Records.`DateOfBirth`, 
   Records.`Age`,
   Records.`PatientAddNum`, 
   Records.`ShotsGiven`, 
   Records.`Illnesses`, 
   Appointments.`AppointmentDate`, 
   Appointments.`AppointmentType`,
   Procedures.`ProcedureDate`, 
   Procedures.`ProcedureType`,
   Doctors.`DoctorName`,
   Doctors.`DoctorID`
   FROM Patients
   LEFT JOIN Receptionist ON Patients.`ReceptionistID` = Receptionist.`ReceptionistID`
   LEFT JOIN Records ON Patients.`PatientID` = Records.`PatientID`
   LEFT JOIN Appointments ON Patients.`PatientID` = Appointments.`PatientID`
   LEFT JOIN Procedures ON Procedures.`PatientID` = Appointments.`PatientID`
   LEFT JOIN Doctors ON Doctors.`PatientID` = Appointments.`PatientID`
   WHERE Receptionist.`ReceptionistID` = '$id'";

$queryRun = mysqli_query($con, $query);
echo '<div>';
echo "<table>";
echo "<tr>";
while ($next = mysqli_fetch_field($queryRun)) {
   echo "<th>" . $next->name . "</th>";
}
echo "</tr>";
while ($row = mysqli_fetch_assoc($queryRun)) {
   echo "<tr>";
   foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
   }
   echo "</tr>";
}
echo "</table>";
echo '</div>';
mysqli_close($con);
?>