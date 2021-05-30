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
                    <a href="/en/signataires.php" class="menu__bar__title menu__bar__title2 grey2">
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
                <a href="/en/index.php" class="title__main medium">Manifesto</a>
                <div class="title__sub red1 medium">for Sustainable Practices<br>in Creative Activities</div>
                <div class="title__descr purple2 bold">Initiated by a collective at the École Nationale Supérieure des Arts Décoratifs<br>(National Higher School of Decorative Arts), ENSAD – Paris, France</div>
            </div>
            <div class="spacer"></div>
        </header>

        <div class="main-container">
            <div class="form">
                <a href="/en/signataires.php" class="form__header bold">Je rejoins les <br> <span id="nb-signataires" class="red1"><?php echo $total; ?></span> <br>
                    <div class="underline">signataires</div>
                </a>
                <p class="grey1 form__intro">Vous pouvez signer en votre nom et prénom, ou avec un pseudonyme (les mentions avec astérisques sont obligatoires).</p>

                <form id="sign-form" action="/add-signataire.php" method="post">
                    <?php

                    $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
                    $url = 'en/signataires.php';

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
                        <label for="accept">J’accepte que ces informations soient affichées sur la page <a href="en/signataires.php">signataires</a> (seul l’e-mail n’y figurera pas).
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
                        graphisme de ce site reprend et prolonge les choix effectués pour <a href="/en/apropos.php">la première mise
                            en forme de
                            ce manifeste sur panneaux sérigraphiés</a>, basée sur un procédé de récupération de grands
                        supports
                        de bois et de restes d’encres sérigraphiques.
                        Le développement a été assuré par Daniel Djordjevic.</p>
                </form>
            </div>
            <div>

                <p class="blue1">Faced with today’s highly critical environmental and ecological challenges, all of us involved in creative activities have decided to implement a major movement of transition and reconfiguration. The urgency of the current situation requires us to enforce our capacity to assess, rethink, express and reinvent.</p>
                <br>
                <p class="blue2">Over and above raising awareness, we consider it imperative to seek solutions and act accordingly – to put creative projects, design and art at the very heart of our challenges – both today and tomorrow. Our overriding concern is with the preservation of the environment, which requires the sustainability and renewal of our habitual practices as well as our lifestyles. Design and art have a vital role to play in contributing to this growing awareness, and in allowing us to find the right balance to satisfy the basic needs of the environment and of living things in a sustainable way.</p>
                <br>
                <p class="blue3">For these reasons, we are committed to adopting actively new professional, individual, collective and behavioural practices. Beyond that, we will need to conceive, plan and implement new operating methods – civic, cooperative, environmental, ecological, economic, etc.</p>
            </div>
            <div>
                <div class="red2 medium">Our goal is to foster: </div>
                <ul class="red2">
                    <li>– the emergence of a sustainable and resilient world</li>
                    <li>– the adoption of ethical values that protect life, the environment and the ecosphere</li>
                    <li>– à l’utilisation raisonnée des ressources,
                    </li>
                    <li>– the rational use of resources</li>
                    <li>– the consideration of the entire life cycle of products
                        and to reduce the environmental impact of our choices, our actions and our productions.
                    </li>
                </ul>

                <br>
                <p class="blue1">To this end, we need to redefine our priorities, develop the necessary expertise, question our practices, work with frugality in mind, identify and distinguish fundamental needs, opt for solutions that preserve environmental health and life, and eliminate all forms of waste.</p>

                <p class="blue1">These objectives require ecological awareness and action, espousing a holistic, interdependent vision of the world.</p>
            </div>
            <div>
                <div class="blue2 medium">We would like to emphasize the responsibility of all creatives in this major social and environmental undertaking in: </div>
                <ul class="blue2">
                    <li>– taking responsibility for our work and the process through which it materializes, in all its dimensions and implications</li>
                    <li>– for each project, evaluating the reason for the commission, work, product or service in light of sustainable objectives</li>
                    <li>– considering the economy of materials and energy as integral and an added value to each project – a vital reflection of our concern for the state of the world and our commitment to nature</li>
                    <li>– promoting frugal practices</li>
                    <li>– helping to alleviate harm to our ecosystems</li>
                    <li>– opting for sustainable choices and favouring reuse to limit the production of new objects</li>
                    <li>– prioritizing simple, repairable, recyclable and biodegradable methods and products.
                    </li>
                </ul>
                <br>
                <p class="red3">In our role both as creatives and citizens, we shall work in the interests of all and sundry. We need to grasp the current global challenge and harness our imagination and creativity in line with our ethical convictions. To this end, we must act with determination and aim for a transformation that is both clear-sighted and stimulating.</p><br>
                <div class="grey1">English translation by Parry Ebrahimzadeh</div>
                <br>
                <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                    <div class="contact bold underline">Email contact</div>
                    <div>manifeste.environnement@ensad.fr</div>
                </a>
            </div>

        </div>


    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>