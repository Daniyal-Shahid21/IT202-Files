<?php
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$connect = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Get form data
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$password = $_POST["password"];
$id = $_POST["id"];
$phoneNumber = $_POST["phoneNumber"];
$email = $_POST["email"];

// Sanitize inputs to prevent SQL injection
$firstName = mysqli_real_escape_string($connect, $firstName);
$lastName = mysqli_real_escape_string($connect, $lastName);
$password = mysqli_real_escape_string($connect, $password);
$id = mysqli_real_escape_string($connect, $id);
$phoneNumber = mysqli_real_escape_string($connect, $phoneNumber);
$email = mysqli_real_escape_string($connect, $email);

// Perform verification
$sql = "SELECT * FROM Receptionist WHERE
    ReceptionistFirstName = '$firstName' AND
    ReceptionistLastName = '$lastName' AND
    ReceptionistPassword = '$password' AND
    ReceptionistID = '$id' AND
    ReceptionistPhoneNumber = '$phoneNumber' AND
    ReceptionistEmailAddress = '$email'";

$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "verified";
} else {
    echo "User not found or verification failed";
}

mysqli_close($connect);
?>
