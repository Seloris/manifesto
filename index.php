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

    <link rel="icon" type="image/png" href="favicon.png" />


    <title>Manifeste</title>
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
                        <a href="/index.php">
                            <img title="Français" src="/img/france.png" alt="Français" class="menu__flag"></a>
                        <a href="/en/index.php">
                            <img title="English" src="/img/uk.png" alt="English" class="menu__flag"></a>
                        <a href="/it/index.php">
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
                <a href="/signataires.php" class="form__header bold">Je rejoins les <br> <span id="nb-signataires" class="red1"><?php echo $total; ?></span> <br>
                    <div class="underline">signataires</div>
                </a>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et prénom, ou avec un pseudonyme (les mentions avec astérisques sont obligatoires).</p>

                <form id="sign-form" action="add-signataire.php" method="post">
                    <?php

                    $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
                    $url = '/signataires.php';

                    ?>

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
                                de ce site
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