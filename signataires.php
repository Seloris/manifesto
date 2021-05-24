<!doctype html>
<html lang="en">
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

// $link = mysqli_connect("localhost", "root", "", "manifesto");
// // Check connection
// if ($link->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


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

$countrySql = "SELECT id, country_name FROM countries";
$countryRes = $pdo->query($countrySql);
$countries = $countryRes->fetchAll();


$total = $pdo->query('select count(*) from signataires')->fetchColumn();

?>

<head>
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reboot.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/signataires.css" />


    <title></title>
</head>

<body>
    <div class="app">
        <header>
            <div class="menu">

                <div class="menu__bar">
                    <div class="menu__bar__title grey2">A propos</div>

                    <div class="menu__flags">
                        <img src="./img/france.png" alt="france" class="menu__flag">
                        <img src="./img/uk.png" alt="anglais" class="menu__flag">
                        <img src="./img/italie.png" alt="italie" class="menu__flag">
                    </div>
                </div>

                <p class="menu__text grey1">Le manifeste « Pour une pratique soutenable de
                    la création » est issu d’initiatives et d’échanges entre Vonnik Hertig et Roxane Jubert et Annabel
                    Vergne, qui ont réuni un groupe rassemblant des étudiant·es, des personnels et des enseignant·es
                    de l’ENSAD, afin d’engager une réflexion
                    transversale et de parvenir à un texte qui formule un engagement collectif face aux déséquilibres
                    planétaires et aux enjeux écologiques.</p>
            </div>
            <div class="title">
                <div class="title__main medium">Manifeste</div>
                <div class="title__sub red1 medium">Pour une pratique soutenable <br>de la création</div>
                <div class="title__descr purple2 bold">A l'initiative d'un groupe de l'Ecole<br> Nationale Supérieure
                    des
                    Arts
                    Décoratifs<br>
                    (ENSAD, Paris, France)</div>
            </div>
            <div class="spacer"></div>
        </header>

        <div class="main-container">
            <div class="form">
                <div class="form__header red1 medium">Rejoindre<br> les <span id="nb-signataires"><?php echo $total; ?></span> <br><a href="./signataires.php">signataires</a>
                </div>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et/ou prénom avec un pseudonyme :
                    ces mentions ainsi que
                    votre e-mail, sont obligatoires. Les autres champs sont optionnels.</p>
                <form id="sign-form" class="grey1" action="add-signataire.php" method="post">
                    <div class="form-group__field">
                        <label for="lastName">nom ou pseudonyme *</label>
                        <input type="text" name="lastName" />
                    </div>
                    <div class="form-group__field">
                        <label for="firstName">prénom ou pseudonyme *</label>
                        <input type="text" name="firstName" />
                    </div>
                    <div class="form-group__field">
                        <label for="email">e-mail</label>
                        <input type="text" name="email" />
                    </div>
                    <div class="form-group__field">
                        <label for="activity">activité/situation</label>
                        <input type="text" name="activity" />
                    </div>
                    <!-- <div class="form-group__field">
                        <label for="country">pays</label>
                        <input type="text" name="country" />
                    </div> -->
                    <div class="form-group__field">
                        <label for="country">pays</label>
                        <select name="country">
                            <option value="null">-</option>
                            <?php
                            foreach ($countries as $country) {
                                printf('<option value="%s">%s</option>', $country["id"], $country["country_name"]);
                            }
                            ?>
                        </select>
                    </div>

                    <div class="checkbox">
                        <input id="accept" name="accept" type="checkbox" />
                        <label for="accept">J’accepte que ces informations soient affichées sur la page <a href="#">signataires</a>.
                    </div>
                    <a class="form__sign" href="javascript:;" onclick="document.getElementById('sign-form').submit();">Je signe</a>

                    <div class="form__apropos__title grey2">A propos du site</div>
                    <p class="form__apropos grey1">Ce site a été conçu graphiquement par Madeleine Lequoy, étudiante en
                        Design
                        Graphique à l’ENSAD, dans le cadre de cours de Roxane Jubert et Vonnik Hertig, en 2020-2021. Le
                        graphisme de ce site reprend et prolonge les choix effectués pour <a href="#">la première mise
                            en forme de
                            ce manifeste sur panneaux sérigraphiés</a>, basée sur un procédé de récupération de grands
                        supports
                        de bois et de restes d’encres sérigraphiques.
                        Le développement a été assuré par Daniel Djordjevic.</p>
                </form>
            </div>
            <div>
                <select id="sort-names">
                    <option <?php echo $sort == 'date-desc' || !isset($sort) ? 'selected="selected"' : '' ?> value="date-desc">Signataires récents</option>
                    <option <?php echo $sort == 'date-asc' ? 'selected="selected"' : '' ?> value="date-asc">Premiers signataires</option>
                    <option <?php echo $sort == 'nom-asc' ? 'selected="selected"' : '' ?> value="nom-asc">De A à Z</option>
                    <option <?php echo $sort == 'nom-desc' ? 'selected="selected"' : '' ?> value="nom-desc">De Z à A</option>
                </select>

                <?php
                foreach ($rows as $row) {
                    printf("<div>%s %s</div>", $row["firstName"], $row["lastName"]);
                }
                ?>
            </div>
            <div>
                <select name="country" id="filter_countries">
                    <option value="">Pays</option>
                    <?php
                    foreach ($countries as $country) {
                        $selected =  $countryFilter == $country["id"];
                        if ($selected)
                            printf('<option selected="selected" value="%s">%s</option>', $country["id"], $country["country_name"]);
                        else
                            printf('<option value="%s">%s</option>', $country["id"], $country["country_name"]);
                    }
                    ?>
                </select>

                <?php
                foreach ($rows as $row) {
                    printf("<div>%s</div>", $row["countryName"]);
                }
                ?>
            </div>
            <div>
                <select>
                    <option>Activité/Situation</option>
                    <option>De A à Z</option>
                    <option>De Z à A</option>
                </select>

                <?php
                foreach ($rows as $row) {
                    printf("<div>%s</div>", $row["activity"]);
                }
                ?>
            </div>
        </div>

    </div>

    <script src="./js/jquery.js"></script>
    <script src="./js/signataires.js"></script>
</body>

</html>