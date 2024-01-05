<?php

$server = "";
$user = "";
$pass = "";
$database = "";

$conn = mysqli_connect(
    $server,
    $user,
    $pass,
    $database
);

if (!$conn) {
    die("Connection Fail: " . mysqli_connect_error());
}

?>
