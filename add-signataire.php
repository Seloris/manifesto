<?php
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$activity = $_REQUEST['activity'];
$country = $_REQUEST['country'];

$dsn = "mysql:host=localhost;dbname=manifesto;charset=utf8mb4";
$options = [
    PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];

try {
    $pdo = new PDO($dsn, "root", "", $options);

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $activity = $_REQUEST['activity'];
    $country = $_REQUEST['country'];

    $stmt = $pdo->prepare("INSERT INTO signataires (firstName, lastName, email, activity, country, signDate) VALUES (:firstName, :lastName, :email, :activity,:country, now())");

    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':activity', $activity);
    $stmt->bindParam(':country', $country);

    $stmt->execute();
} catch (Exception $e) {
    $errMsg = $e->getMessage();
    $err = 1;
    if (isset($err) && strpos($errMsg, "SQLSTATE[23000]: Integrity constraint") === 0) {
        $err = 2;
    }
}

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

header("Location: {$url}");
