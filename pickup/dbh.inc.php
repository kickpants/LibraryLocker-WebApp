<?php

$database_ip = "fau-lpl.cluster-cly8gnirvokz.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "Group8pass";

$link = mysqli_connect($database_ip, $username, $password, "lockers");

if (mysqli_connect_errno()) {
    echo "failed " . mysqli_connect_error();
    exit();
}

//echo "connection successful"
?>