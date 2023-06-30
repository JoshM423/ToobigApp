<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

function getUsernameFromEmail($email) {
    require('db.php');
    $query = "SELECT username FROM `users` WHERE email='$email'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
    return $row['username'];
}
?>