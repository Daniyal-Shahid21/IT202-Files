<?php
$server = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$db = "sds";
$conn = mysqli_connect($server, $username, $password, $db);
$recieverName = $_REQUEST["recieverName"];
$sql = "SELECT users FROM `user_table` WHERE users = '$recieverName'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $text = "";
    $textSQL = "SELECT `text` 
                FROM `user_table` 
                WHERE `users` = '$recieverName'";

    $result = mysqli_query($conn, $textSQL);
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $value) {
            $text .= $value;
            $text .= "<br>";
        }
    }
    echo $text;
}

mysqli_close($conn);
?>