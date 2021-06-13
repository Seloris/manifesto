<!doctype html>
<html lang="en">


<?php
include '_get_signataires.php';
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
    <?php
    $currentPage = 'signataires';
    $metaTitle = $tradMetaTitleSignataires;
    include '_tags.php';
    ?>
</head>

<body>
    <div class="app">

        <?php
        include '_header.php';
        ?>


        <div class="main-container">

            <?php include '_form.php'; ?>

            <div class="data">
                <div class="cols">
                    <div class="col">
                        <select id="sort-names">
                            <option <?php echo $sort == 'date-desc' || !isset($sort) ? 'selected="selected"' : '' ?> value="date-desc"><?= $tradSignatairesRecents ?></option>
                            <option <?php echo $sort == 'date-asc' ? 'selected="selected"' : '' ?> value="date-asc"><?= $tradSignatairesPremiers ?></option>
                            <option <?php echo $sort == 'nom-asc' ? 'selected="selected"' : '' ?> value="nom-asc"><?= $tradSignatairesAtoZ ?></option>
                            <option <?php echo $sort == 'nom-desc' ? 'selected="selected"' : '' ?> value="nom-desc"><?= $tradSignatairesZtoA ?></option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="country" id="filter_countries">
                            <option value=""><?= $tradCountry ?></option>
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
                </div>

                <?php
                foreach ($rows as $row) {
                    $activity = $row["activity"];
                    $country = $row["countryName"];

                    if (!empty($activity)) {
                        $country .= ' – ';
                    }

                    printf('<div class="person"><div class="row bold blue2">%s %s</div><div class="row blue4"> – %s</div><div class="row blue5">%s</div></div>', $row["lastName"], $row["firstName"], $country, $activity);
                }
                ?>

                <a class="mailto blue4" href="mailto:manifeste.environnement@ensad.fr">
                    <div class="contact bold underline"><?= $tradContact ?></div>
                    <div>manifeste.environnement@ensad.fr</div>
                </a>
            </div>
        </div>

        <?php include '_footer.php'; ?>
    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/signataires.js"></script>
</body>

</html>