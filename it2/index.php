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
    <link rel="stylesheet" href="/css/reboot.css" />
    <link rel="stylesheet" href="/css/style.css" />

    <script src="/js/script.js"></script>

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
                    <a href="/it/signataires.php" class="menu__bar__title menu__bar__title2 grey2">
                        Liste des signataires</a>
                </div>
                <p class="menu__text grey1">Le manifeste « Pour une pratique soutenable de
                    la création » est issu d’initiatives et d’échanges entre Vonnik Hertig et Roxane Jubert et Annabel
                    Vergne, qui ont réuni un groupe rassemblant des étudiant·es, des personnels et des enseignant·es
                    de l’ENSAD, afin d’engager une réflexion
                    transversale et de parvenir à un texte qui formule un engagement collectif face aux déséquilibres
                    planétaires et aux enjeux écologiques.</p>
            </div>
            <div class="title">
                <a href="/it/index.php" class="title__main medium">Manifesto</a>
                <div class="title__sub red1 medium">per una pratica sostenibile<br>della creazione</div>
                <div class="title__descr purple2 bold">All’iniziativa di un collettivo dell’École Nationale Supérieure des Arts Décoratifs<br>(Scuola Nazionale Superiore delle arti Decorative), ENSAD – Parigi, Francia</div>
            </div>
            <div class="spacer"></div>
        </header>

        <div class="main-container">
            <div class="form">
                <a href="/it/signataires.php" class="form__header bold">Je rejoins les <br> <span id="nb-signataires" class="red1"><?php echo $total; ?></span> <br>
                    <div class="underline">signataires</div>
                </a>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et prénom, ou avec un pseudonyme (les mentions avec astérisques sont obligatoires).</p>

                <form id="sign-form" action="/add-signataire.php" method="post">
                    <?php

                    $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
                    $url = 'it/signataires.php';

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
                        <label for="activity">activité / situation</label>
                    </div>

                    <div class="checkbox grey1">
                        <input required class="chk" <?php echo $signed ? 'onclick="return false;"' : '' ?> id="accept" name="accept" type="checkbox" />
                        <label for="accept">J’accepte que ces informations soient affichées sur la page <a href="it/signataires.php">signataires</a> (seul l’e-mail n’y figurera pas).
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
                        graphisme de ce site reprend et prolonge les choix effectués pour <a href="/it/apropos.php">la première mise
                            en forme de
                            ce manifeste sur panneaux sérigraphiés</a>, basée sur un procédé de récupération de grands
                        supports
                        de bois et de restes d’encres sérigraphiques.
                        Le développement a été assuré par Daniel Djordjevic.</p>
                </form>
            </div>
            <div>

                <p class="blue1">Confrontati alle gravi questioni ambientali e alle immense sfide ecologiche, noi tutti e tutte, coinvolti nella creazione, siamo determinati a iscriverci in un movimento di transizione e riconfigurazione. L’urgenza della situazione attuale ci obbliga a mobilizzare le nostre capacità di comprensione, recupero, espressione e reinvenzione.</p>
                <br>
                <p class="blue2">É importante cercare soluzioni e agire, andando oltre la semplice presa di coscienza e di mettere la creazione, il design e l’arte al servizio delle sfide del presente e del futuro. Le sfide riguardano innanzitutto la salvaguardia dell’ambiente, che implica la sostenibilità e il rinnovo delle nostre pratiche e stili di vita. Il design e l’arte svolgono un ruolo essenziale nel contribuire a questa crescente consapevolezza e nel partecipare alla ricerca di un equilibrio che si prefigge di soddisfare in modo duraturo i bisogni fondamentali dell’ambiente e degli esseri viventi.</p>
                <br>
                <p class="blue3">Per questi motivi, ci impegniamo a partecipare attivamente all’adozione di nuove pratiche professionali, individuali, collettive e comportamentali. Si tratta inoltre d’immaginare, progettare e instaurare nuove modalità di funzionamento – responsabili, solidali, ambientali, ecologiche, economiche, ecc.</p>
            </div>
            <div>
                <div class="red2 medium">Vogliamo contribuire:</div>
                <ul class="red2">
                    <li>– all’emergenza di un mondo sostenibile, duraturo e resiliente</li>
                    <li>– all’adozione di valori etici rispettosi della vita, dell’ambiente e dell’ecosfera</li>
                    <li>– all’uso ragionato delle risorse
                    </li>
                    <li>– alla considerazione del ciclo di vita degli oggetti</li>
                    <li>– a un minor impatto ambientale delle nostre scelte, azioni e produzioni.
                    </li>
                </ul>

                <br>
                <p class="blue1">Per questo dobbiamo ridefinire le priorità, sviluppare conoscenze adeguate, rivedere le nostre pratiche, lavorare integrando la nozione di sobrietà, identificare e distinguere i bisogni fondamentali, optare per le soluzioni che favoriscono la salute dell’ambiente e degli esseri viventi, eliminare lo spreco.</p>

                <p class="blue1">Tali obiettivi implicano una coscienza e un’azione ecologiche che partecipano di una visione olistica e solidale del mondo.</p>
            </div>
            <div>
                <div class="blue2 medium">Sottolineiamo la responsabilità dei creativi e delle creative in questo grande cantiere sociale e ambientale:</div>
                <ul class="blue2">
                    <li>– siamo responsabili delle nostre opere e delle loro realizzazioni, in tutte le loro dimensioni e implicazioni</li>
                    <li>– nell’ambito dei progetti dobbiamo valutare il senso della richiesta, dell’opera, del prodotto o del servizio rispetto agli obiettivi di sostenibilità</li>
                    <li>– con un atteggiamento attento allo stato del mondo e rispettoso della natura, dobbiamo fare del risparmio di materia ed energia un valore aggiunto al progetto</li>
                    <li>– affermiamo l’importanza di pratiche umili</li>
                    <li>– vogliamo contribuire a ridurre l’impatto sugli ecosistemi</li>
                    <li>– dobbiamo privilegiare le scelte durature, il riutilizzo piuttosto che il nuovo, la semplicità nell’uso e nella pratica, la riparabilità, il riciclaggio e la biodegradabilità.</li>

                </ul>
                <br>
                <p class="red3">In quanto creativi, creative, cittadine, cittadini, dobbiamo operare nel senso dell’interesse collettivo e generale. Gli attuali problemi planetari rappresentano una sfida alle nostre capacità d’immaginazione e creazione, oltre che alle nostre esigenze etiche. Perciò dobbiamo agire con determinazione e mirare a una trasformazione tanto lucida quanto stimolante.</p><br>
                <div class="grey1">Traduzione in italiano di Orsina Visconti<br>Revisione di Mariacristina Bonini</div>
                <br>
                <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                    <div class="contact bold underline">Contatto</div>
                    <div>manifeste.environnement@ensad.fr</div>
                </a>
            </div>

        </div>


    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>