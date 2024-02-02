<?php
$server = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$db = "sds";
$conn = mysqli_connect($server, $username, $password, $db);

$senderName = $_REQUEST["senderName"];
$senderPass = $_REQUEST["senderPass"];
$message = $_REQUEST["message"];
$sql = "SELECT users 
        FROM `user_table` 
        WHERE users = '$senderName' AND password = '$senderPass'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $messageSQL = "UPDATE `user_table` 
                   SET `users`='$senderName',`password`='$senderPass',`text`='$message' 
                   WHERE `users`='$senderName' && `password`='$senderPass'";
    mysqli_query($conn, $messageSQL);
} 

elseif ($senderName != "" && $senderPass != "") {
    echo "Invalid User";
}

mysqli_close($conn);
?>