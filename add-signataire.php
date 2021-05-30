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
    $err = mysqli_error($link);

    if (isset($err) && strpos($err, "Duplicate entry") === 0) {
        $err = 2;
    } else {
        $err = 1;
    }
}
// Close connection
mysqli_close($link);

$url = "";

if (isset($_REQUEST["destination"])) {
    $url = $_REQUEST["destination"];
} else if (isset($_SERVER["HTTP_REFERER"])) {
    $url = $_SERVER["HTTP_REFERER"];
} else {
    echo 'Une erreur interne est survenue.';
}

if ($url != "" && !empty($err)) {
    $url .= "?tri=date-desc&error={$err}";
} else if ($url != "" && empty($err)) {
    $url .= "?tri=date-desc&signed=1";
}

// echo $url;
header("Location: {$url}");
