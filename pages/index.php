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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reboot.css" />
    <link rel="stylesheet" href="/css/style.css" />

    <link rel="icon" type="image/png" href="/favicon.png" />


    <title><?= $tradTitle ?></title>
</head>

<body>
    <div class="app">
        <?php
        $currentPage = 'index';
        include '_header.php';
        ?>

        <div class="main-container">
            <?php include '_form.php'; ?>
            <div class="columns">
                <div>

                    <p class="blue1"><?= $tradManifP1 ?></p>
                    <br>
                    <p class="blue2"><?= $tradManifP2 ?></p>
                    <br>
                    <p class="blue3"><?= $tradManifP3 ?></p>
                </div>
                <div>
                    <div class="red2 medium"><?= $tradManifListHeader1 ?></div>
                    <ul class="red2">
                        <?= $tradManifList1 ?>
                    </ul>

                    <br>
                    <p class="blue1"><?= $tradManifP4 ?></p>
                </div>
                <div>
                    <div class="blue2 medium"><?= $tradManifListHeader2 ?></div>
                    <ul class="blue2">
                        <?= $tradManifList2 ?>
                    </ul>
                    <br>
                    <p class="red3"><?= $tradManifP5 ?></p>
                    <br>
                    <?php echo isset($tradTranslator) ?  $tradTranslator : ''; ?>
                    <br>
                    <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                        <div class="contact bold underline"><?= $tradContact ?></div>
                        <div>manifeste.environnement@ensad.fr</div>
                    </a>
                </div>
            </div>

            <div class="columns-md">
                <div>
                    <p class="blue1"><?= $tradManifP1 ?></p>
                    <br>
                    <p class="blue2"><?= $tradManifP2 ?></p>
                    <br>
                    <p class="blue3"><?= $tradManifP3 ?></p>
                    <br>
                    <div class="red2 medium"><?= $tradManifListHeader1 ?></div>
                    <ul class="red2">
                        <?= $tradManifList1 ?>
                    </ul>

                </div>
                <div>
                    <p class="blue1"><?= $tradManifP4 ?></p>
                    <br>
                    <div class="blue2 medium"><?= $tradManifListHeader2 ?></div>
                    <ul class="blue2">
                        <?= $tradManifList2 ?>
                    </ul>
                    <br>
                    <p class="red3"><?= $tradManifP5 ?></p>
                    <br>
                    <?php echo isset($tradTranslator) ?  $tradTranslator : ''; ?>
                    <br>
                    <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                        <div class="contact bold underline"><?= $tradContact ?></div>
                        <div>manifeste.environnement@ensad.fr</div>
                    </a>
                </div>
            </div>
        </div>

        <?php include '_footer.php'; ?>

    </div>


    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>