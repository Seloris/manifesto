<?php

$dsn = "mysql:host=localhost;dbname=manifesto;charset=utf8mb4";
$options = [
    PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];

$pdo = new PDO($dsn, "root", "", $options);

$countryFilter = isset($_GET["pays"]) ? htmlspecialchars($_GET["pays"]) : null;
$sort = isset($_GET["tri"]) ? htmlspecialchars($_GET["tri"]) : null;

$order = 'ORDER BY signDate desc';

$sql = "SELECT `firstName`, `lastName`, `email`, `activity`, `country`, `signDate`, C.country_name `countryName` FROM `signataires` 
left join countries C on C.Id = country";

if ($countryFilter != null)
    $sql .= " WHERE country = :country ";

if ($sort == "nom-asc") {
    $sql .= " ORDER BY lastName asc";
} else if ($sort == "nom-desc") {
    $sql .= " ORDER BY lastName desc";
} else if ($sort == "date-asc") {
    $sql .= " ORDER BY signDate asc";
} else if ($sort == "date-desc") {
    $sql .= " ORDER BY signDate desc";
} else
    $sql .= " ORDER BY signDate desc";

$sth = $pdo->prepare($sql);
$params = array();
if ($countryFilter)
    $params[':country'] = $countryFilter;
$sth->execute($params);
$rows = $sth->fetchAll();

$countryRes = $pdo->query("SELECT id, country_name FROM countries WHERE id in (SELECT C.id FROM countries C INNER JOIN signataires S on S.Country = C.Id)");
$countries = $countryRes->fetchAll();


$countriesAll = $pdo->query("SELECT id, country_name FROM countries")->fetchAll();


$total = $pdo->query('select count(*) from signataires')->fetchColumn();

$pdo = null;
