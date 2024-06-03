<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "root";
$dbName = "Cms";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Something went wrong. Database is not connected;");
}
?>