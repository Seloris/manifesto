<?php
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$activity = $_REQUEST['activity'];
$country = $_REQUEST['country'];


// TO PDO
$link = mysqli_connect("localhost", "root", "", "manifesto");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$firstName = mysqli_real_escape_string($link, $_REQUEST['firstName']);
$lastName = mysqli_real_escape_string($link, $_REQUEST['lastName']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$activity = mysqli_real_escape_string($link, $_REQUEST['activity']);
$country = mysqli_real_escape_string($link, $_REQUEST['country']);

$sql = "INSERT INTO signataires (firstName, lastName, email, activity, country, signDate) VALUES ('$firstName', '$lastName', '$email', '$activity',$country, now())";
if (mysqli_query($link, $sql)) {
    echo "OK";
} else {
    echo "OUPS $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);


if (isset($_REQUEST["destination"])) {
    header("Location: {$_REQUEST["destination"]}");
} else if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: {$_SERVER["HTTP_REFERER"]}");
} else {
    /* some fallback, maybe redirect to index.php */
}
