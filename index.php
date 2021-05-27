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

$total = $pdo->query('select count(*) from signataires')->fetchColumn();

$countriesAll = $pdo->query("SELECT id, country_name FROM countries")->fetchAll();
$pdo = null;
?>

<head>
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reboot.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script src="js/script.js"></script>

    <title></title>
</head>

<body>
    <div class="app">
        <header>
            <div class="menu">

                <div class="menu__bar">
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
                <a href="./index.php" class="title__main medium">Manifeste</a>
                <div class="title__sub red1 medium">pour une pratique soutenable <br>de la création</div>
                <div class="title__descr purple2 bold">À l’initiative d’un groupe de l’École Nationale Supérieure <br>
                    des
                    Arts
                    Décoratifs (ENSAD, Paris, France)</div>
            </div>
            <div class="spacer"></div>
        </header>

        <div class="main-container">
            <div class="form">
                <a href="./signataires.php" class="form__header bold">Je rejoins les <br> <span id="nb-signataires" class="red1"><?php echo $total; ?></span> <br>
                    <div class="underline">signataires</div>
                </a>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et prénom, ou avec un pseudonyme (les mentions avec astérisques sont obligatoires).</p>
                <br>
                <br>
                <form id="sign-form" action="add-signataire.php" method="post">
                    <?php
                    $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
                    $url = $_SERVER["REQUEST_URI"];
                    $query = parse_url($url, PHP_URL_QUERY);
                    if (!$signed) {
                        if ($query) {
                            $url .= '&signed=1';
                        } else {
                            $url .= '?signed=1';
                        }
                    }
                    ?>

                    <input id="destination" type="hidden" name="destination" value="<?php echo $url ?>" />

                    <div class="form-group__field">
                        <!-- <label for="lastName">nom ou pseudonyme *</label> -->
                        <input id="lastName" required <?php echo $signed ? 'readonly' : '' ?> type="text" name="lastName" />
                        <label for="lastName">nom ou pseudonyme *</label>

                    </div>
                    <div class="form-group__field">
                        <input id="firstName" <?php echo $signed ? 'readonly' : '' ?> type="text" name="firstName" />
                        <label for="firstName">prénom</label>
                    </div>
                    <div class="form-group__field">
                        <input id="email" required <?php echo $signed ? 'readonly' : '' ?> type="email" name="email" />
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
                        <input id="activity" <?php echo $signed ? 'readonly' : '' ?> type="text" name="activity" />
                        <label for="activity">activité / situation</label>
                    </div>

                    <div class="checkbox grey1">
                        <input required class="chk" <?php echo $signed ? 'onclick="return false;"' : '' ?> id="accept" name="accept" type="checkbox" />
                        <label for="accept">J’accepte que ces informations soient affichées sur la page <a href="/signataires.php">signataires</a> (seul l’e-mail n’y figurera pas).
                    </div>


                    <?php

                    if ($signed) {
                    ?>
                        <div class="thanks bold"><span class="red1">Merci</span> <br>d’avoir rejoint<br> les signataires </div>
                    <?php
                    } else {
                    ?>


                        <button class="submit-btn red1 bold" type="submit"><span class="underline">Je signe</span></button>
                        <!-- <a class="form__sign" href="javascript:;" onclick="document.getElementById('sign-form').submit();">Je signe</a> -->


                        <button id="fill" type="button"> fill</button>
                    <?php
                    }
                    ?>


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

                <p class="blue1">Face aux enjeux environnementaux et aux
                    immenses défis écologiques, nous toutes
                    et tous, concernés par la création, sommes
                    déterminés à nous inscrire dans un
                    mouvement de transition et de
                    reconfiguration. L’urgence de la situation
                    actuelle nous oblige à mobiliser nos capacités
                    de compréhension, de ressaisissement,
                    d’expression et de réinvention.</p>
                <br>
                <p class="blue2">Au-delà d’une prise de conscience, il importe
                    de chercher des solutions et d’agir, de mettre la
                    création, le design et l’art au service des enjeux
                    du présent et du futur. Les défis à relever
                    concernent avant tout la préservation de
                    l’environnement, qui implique la soutenabilité
                    et le renouvellement de nos pratiques aussi
                    bien que de nos modes de vie. Le design et l’art
                    ont leur rôle à jouer pour contribuer à cette
                    prise de conscience croissante, et participer
                    à la recherche de cet équilibre qui vise à
                    satisfaire durablement les besoins
                    fondamentaux de l’environnement et du vivant.</p>
                <br>
                <p class="blue3">Pour ces raisons, nous nous engageons à
                    prendre activement notre part dans
                    l’adoption de nouvelles pratiques
                    professionnelles, individuelles, collectives et
                    comportementales. Au-delà, il s’agit
                    d’imaginer, de projeter et de mettre en place
                    de nouvelles modalités de fonctionnement
                    – citoyennes, solidaires, environnementales,
                    écologiques, économiques, etc.</p>
            </div>
            <div>
                <div class="red2 medium">Nous voulons contribuer :</div>
                <ul class="red2">
                    <li>– à l’émergence d’un monde soutenable,
                        durable et résilient,</li>
                    <li>– à l’adoption de valeurs éthiques
                        respectueuses du vivant, de l’environnement
                        et de l’écosphère,</li>
                    <li>– à l’utilisation raisonnée des ressources,
                    </li>
                    <li>– à la considération du cycle de vie des
                        objets,</li>
                    <li>– à un moindre impact environnemental
                        de nos choix, de nos actions et de nos
                        productions.</li>
                </ul>

                <br>
                <p class="blue1">Pour cela, nous devons redéfinir nos priorités,
                    développer des savoirs appropriés,
                    réinterroger nos pratiques, travailler en
                    intégrant la sobriété, identifier et distinguer
                    les besoins fondamentaux, opter pour les
                    solutions qui épargnent la santé
                    environnementale et le vivant, éliminer ce
                    qui relève du gaspillage.</p>

                <p class="blue1">Ces objectifs impliquent une conscience et
                    une action écologiques, qui participent d’une
                    vision holistique et solidaire du monde.</p>
            </div>
            <div>
                <div class="blue2 medium">Nous soulignons la responsabilité des créateurs
                    et créatrices dans ce grand chantier social et
                    environnemental :</div>
                <ul class="blue2">
                    <li>– nous sommes responsables de nos œuvres
                        et de leurs réalisations, dans toutes leurs
                        dimensions et implications,</li>
                    <li>– dans le cadre des projets, nous devons
                        évaluer le sens de la commande, de l’œuvre,
                        du produit ou du service, au regard des
                        objectifs de soutenabilité,</li>
                    <li>– nous devons, par une attitude soucieuse de
                        l’état du monde et respectueuse de la nature,
                        considérer l’économie de matière et d’énergie
                        comme une valeur ajoutée au projet,</li>
                    <li>– nous affirmons l’importance de pratiques
                        humbles,</li>
                    <li>– nous souhaitons contribuer à réduire toute
                        nuisance sur les écosystèmes,</li>
                    <li>– nous devons privilégier les choix durables,
                        le réemploi plutôt que le neuf, la simplicité de
                        l’utilisation et de la pratique, la réparabilité, la
                        recyclabilité et la biodégradabilité.</li>
                </ul>
                <br>
                <p class="red3">En tant que créateurs, créatrices, citoyennes
                    et citoyens, nous devons œuvrer à l’intérêt
                    collectif et général. L’actuel enjeu planétaire
                    représente un défi à saisir concernant nos
                    capacités d’imagination et de création, ainsi
                    que notre exigence d’éthique. Pour cela, il
                    nous faut agir avec détermination, et viser une
                    transformation aussi lucide que stimulante.</p><br><br>
                <div class="blue4">
                    <div class="contact bold underline">Contact</div>
                    <div>manifeste.environnement@ensad.fr</div>
                </div>
            </div>

        </div>


    </div>

    <script src="./js/jquery.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>