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

$countryRes = $pdo->query("SELECT id, country_name FROM countries WHERE id in (SELECT C.id FROM countries C INNER JOIN Signataires S on S.Country = C.Id)");
$countries = $countryRes->fetchAll();


$countriesAll = $pdo->query("SELECT id, country_name FROM countries")->fetchAll();


$total = $pdo->query('select count(*) from signataires')->fetchColumn();

$pdo = null;
?>

<head>
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reboot.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/signataires.css" />


    <title></title>
</head>

<body>
    <div class="app">
        <header>
            <div class="menu">

                <div class="menu__bar menu__bar1">
                    <div class="menu__bar__title grey2">
                        <div class="space-right">
                            À propos
                        </div><svg class="chevron chevron1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">

                            <g>
                                <polygon points="225.813,48.907 128,146.72 30.187,48.907 0,79.093 128,207.093 256,79.093 		" />
                            </g>
                        </svg>
                    </div>

                    <div class="menu__flags">
                        <a href="/signataires.php">
                            <img title="Français" src="/img/france.png" alt="Français" class="menu__flag"></a>
                        <a href="/en/signataires.php">
                            <img title="English" src="/img/uk.png" alt="English" class="menu__flag"></a>
                        <a href="/it/signataires.php">
                            <img title="Italiano" src="/img/italie.png" alt="Italiano" class="menu__flag"></a>
                    </div>
                </div>
                <div class="menu__bar menu__bar2">
                    <a href="/signataires.php" class="menu__bar__title menu__bar__title2 grey2">
                        Liste des signataires</a>
                </div>
                <p class="menu__text grey1">Le <i>Manifeste pour une pratique soutenable de la création</i> a été rédigé à l’ENSAD (Paris, France) en 2019 par Vonnik Hertig, Roxane Jubert et Annabel Vergne, et a été finalisé par un groupe élargi à Clément Assoun, Margot Bonnafous, Michèle Ducret, Marion Leclercq, Clémence Leveugle, Coralie Nadaud, Martine Nicot et Christophe Thomas. Ce manifeste, issu d’initiatives croisées et nourri de nombreux échanges d’un collectif, est porté par un groupe rassemblant des étudiant·es, des personnels administratifs, des responsables d’atelier et des enseignant·es de l’ENSAD. Il vise à formuler une réflexion transversale – comme base d’un engagement commun et participatif face aux déséquilibres planétaires et aux enjeux écologiques, sociaux et sanitaires.
                    Ce manifeste, diffusé au sein de l’ENSAD fin 2019, a alors recueilli 160 signatures, représentatives de toutes les composantes de l’école.
                    Notre intention est de partager ce texte avec toutes les personnes qui s’y reconnaissent et qui souhaitent rejoindre les signataires. Nous enrichirons au fil du temps les langues de traduction de ce site web, ouvert en juin 2021.
                </p>
            </div>
            <div class="title">
                <a href="/index.php" class="title__main medium">Manifeste</a>
                <div class="title__sub red1 medium">pour une pratique soutenable <br>de la création</div>
                <div class="title__descr purple2 bold">À l’initiative d’un collectif de l’École Nationale Supérieure <br>
                    des
                    Arts
                    Décoratifs (ENSAD – Paris, France)</div>
            </div>
            <div class="spacer"></div>
        </header>

        <div class="main-container">
            <div class="form">


                <?php

                $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
                $url = '/signataires.php';

                if ($signed) {
                ?>
                    <div class="thanks bold"><span class="red1">Merci</span> <br>d’avoir rejoint<br> les signataires </div>
                <?php
                } else {
                ?>
                    <a href="/signataires.php" class="form__header bold">Je rejoins les <br> <span id="nb-signataires" class="red1"><?php echo $total; ?></span> <br>
                        <div class="underline">signataires</div>
                    </a>

                <?php
                }
                ?>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et prénom, ou avec un pseudonyme (les mentions avec astérisques sont obligatoires).</p>

                <form id="sign-form" action="add-signataire.php" method="post">
                    <input id="destination" type="hidden" name="destination" value="<?php echo $url ?>" />

                    <div class="form-group__field">
                        <!-- <label for="lastName">nom ou pseudonyme *</label> -->
                        <input type="text" id="lastName" required maxlength="30" <?php echo $signed ? 'readonly' : '' ?> name="lastName" />
                        <label for="lastName">nom ou pseudonyme *</label>

                    </div>
                    <div class="form-group__field">
                        <input maxlength="30" id="firstName" <?php echo $signed ? 'readonly' : '' ?> type="text" name="firstName" />
                        <label for="firstName">prénom</label>
                    </div>
                    <div class="form-group__field">
                        <input maxlength="50" id="email" required <?php echo $signed ? 'readonly' : '' ?> type="email" name="email" />
                        <label for="email">e-mail *</label>
                    </div>
                    <div class="form-group__field">
                        <select id="country" required <?php echo $signed ? 'disabled="true"' : '' ?> name="country">
                            <option value="null"></option>
                            <?php
                            foreach ($countriesAll as $country) {
                                printf('<option value="%s">%s</option>', $country["id"], $country["country_name"]);
                            }
                            ?>
                        </select>
                        <label for="country">pays *</label>
                    </div>
                    <div class="form-group__field">
                        <input maxlength="50" id="activity" <?php echo $signed ? 'readonly' : '' ?> type="text" name="activity" />
                        <label for="activity">activité / organisme / établissement</label>
                    </div>

                    <div class="checkbox grey1">
                        <input required class="chk" <?php echo $signed ? 'onclick="return false;"' : '' ?> id="accept" name="accept" type="checkbox" />
                        <label for="accept">J’accepte que ces informations soient affichées sur la page des <a href="/signataires.php">signataires</a> (seul l’e-mail n’y figurera pas).
                    </div>


                    <button <?php echo $signed ? 'disabled' : '' ?> class="submit-btn red1 bold" type="submit"><span class="underline">Je signe</span></button>
                    <button id="fill" type="button"> fill</button>

                </form>


                <div class="form__apropos__title grey2">À propos<br>
                    <div class="flex">
                        <div class="space-right">
                            du site
                        </div>
                        <svg class="chevron chevron2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">

                            <g>
                                <polygon points="225.813,48.907 128,146.72 30.187,48.907 0,79.093 128,207.093 256,79.093 		" />
                            </g>
                        </svg>
                    </div>
                </div>
                <p class="form__apropos grey1">Ce site est le fruit d’un travail collaboratif. Il garde la trace de la <a href="/apropos.php">première mise en forme du manifeste : une installation sérigraphiée placée dans l’espace d’entrée de l’ENSAD</a>. Conception graphique du site : Madeleine Lequoy, étudiante en Design Graphique à l’ENSAD, dans le cadre de cours de Roxane Jubert et Vonnik Hertig.<br>
                    Le graphisme et les couleurs de ce site se fondent sur des choix effectués pour la <a href="/apropos.php">présentation initiale du manifeste, réalisée en sérigraphie fin 2019 sur de grandes planches de bois</a>, entièrement à base de matériaux de récupération (panneaux de bois trouvés dans le garage de l’école, et restes d’encres sérigraphiques, à partir d’un choix très restreint de couleurs au moment de la rentrée 2019).
                    Développement du site : Daniel Djordjevic, 2021.
                </p>
            </div>



            <div class="data">

                <div class="cols">
                    <div class="col">
                        <select id="sort-names">
                            <option <?php echo $sort == 'date-desc' || !isset($sort) ? 'selected="selected"' : '' ?> value="date-desc">Signataires récents</option>
                            <option <?php echo $sort == 'date-asc' ? 'selected="selected"' : '' ?> value="date-asc">Premiers signataires</option>
                            <option <?php echo $sort == 'nom-asc' ? 'selected="selected"' : '' ?> value="nom-asc">De A à Z</option>
                            <option <?php echo $sort == 'nom-desc' ? 'selected="selected"' : '' ?> value="nom-desc">De Z à A</option>
                        </select>
                    </div>
                    <div class="col">
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

                    </div>
                    <div class="col">
                        <select class="activity">
                            <option>Activité / organisme / établissement</option>
                        </select>
                    </div>
                </div>

                <?php
                foreach ($rows as $row) {
                    $activity = $row["activity"];
                    $country = $row["countryName"];

                    if (!empty($activity)) {
                        $country .= ',&nbsp;';
                    }

                    printf('<div class="person"><div class="row bold blue2">%s %s</div><div class="row blue4">&nbsp;– %s</div><div class="row blue5">%s</div></div>', $row["firstName"], $row["lastName"], $country, $activity);
                }
                ?>

                <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                    <div class="contact bold underline">Contact</div>
                    <div>manifeste.environnement@ensad.fr</div>
                </a>
            </div>
        </div>

    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>