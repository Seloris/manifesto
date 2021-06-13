<!doctype html>
<html lang="en">

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

    <?php
    $currentPage = 'apropos';
    $metaTitle = $tradMetaTitleAPropos;
    include '_tags.php';
    ?>
</head>

<body>
    <div class="app app-propos">
        <?php
        include '_header.php';
        ?>

        <div class="main-container container-apropos">
            <div class="form">
                <p class="grey1"><?= $tradPlanche ?></p>


            </div>
            <div class="image">
                <img src="/img/manifeste.jpeg">
            </div>

        </div>

        <div class="flex">
            <div>
                <?php include '_footer.php'; ?></div>
            <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                <div class="contact bold underline"><?= $tradContact ?></div>
                <div>manifeste.environnement@ensad.fr</div>
            </a>
        </div>

    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
</body>

</html>