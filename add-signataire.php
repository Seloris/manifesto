<?php
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$activity = $_REQUEST['activity'];
$country = $_REQUEST['country'];


$link = mysqli_connect("localhost", "root", "", "manifesto");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$firstName = mysqli_real_escape_string($link, $_REQUEST['firstName']);
$lastName = mysqli_real_escape_string($link, $_REQUEST['lastName']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$activity = mysqli_real_escape_string($link, $_REQUEST['activity']);
$country = isset($_REQUEST['country']) ? mysqli_real_escape_string($link, $_REQUEST['country']) : null;

$sql = "INSERT INTO signataires (firstName, lastName, email, activity, country, signDate) VALUES ('$firstName', '$lastName', '$email', '$activity',$country, now())";
if (mysqli_query($link, $sql)) {
    echo "OK";
} else {
    echo "OUPS $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
