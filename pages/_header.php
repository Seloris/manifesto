<header>
    <div class="menu">
        <div class="menu__bar menu__bar1">
            <div class="menu__bar__title grey2">
                <?= $tradAPropos ?>
            </div>
        </div>
        <div class="menu__bar menu__bar2">
            <a href="/<?= $lang ?>/signataires.php" class="menu__bar__title menu__bar__title2 grey2">
                <?= $tradListeDesSignataires; ?></a>
        </div>

        <div class="menu__flags">
            <a href="/fr/<?= $currentPage; ?>.php">
                <img title="Français" src="/img/france.png" alt="Français" class="menu__flag"></a>
            <a href="/en/<?= $currentPage; ?>.php">
                <img title="English" src="/img/uk.png" alt="English" class="menu__flag"></a>
            <a href="/it/<?= $currentPage; ?>.php">
                <img title="Italiano" src="/img/italie.png" alt="Italiano" class="menu__flag"></a>
        </div>
        <p class="menu__text grey1"><?= $tradAProposText; ?>
        </p>
    </div>
    <div class="menu-xs">
        <div class="menu__flags">
            <a href="/fr/<?= $currentPage; ?>.php">
                <img title="Français" src="/img/france.png" alt="Français" class="menu__flag"></a>
            <a href="/en/<?= $currentPage; ?>.php">
                <img title="English" src="/img/uk.png" alt="English" class="menu__flag"></a>
            <a href="/it/<?= $currentPage; ?>.php">
                <img title="Italiano" src="/img/italie.png" alt="Italiano" class="menu__flag"></a>
        </div>
        <div class="menu-list">
            <div class="menu__bar menu__bar1">
                <div class="menu__bar__title grey2">
                    <?= $tradAPropos ?>
                </div>
            </div>
            <div class="menu__bar menu__bar2">
                <a href="/<?= $lang ?>/signataires.php" class="menu__bar__title menu__bar__title2 grey2">
                    <?= $tradListeDesSignataires; ?></a>
            </div>
        </div>

        <p class="menu__text  grey1"><?= $tradAProposText; ?>
        </p>
    </div>
    <div class="title">
        <a href="/<?= $lang ?>/index.php" class="title__main medium">
            <?= $tradTitle ?>
        </a>
        <div class="title__sub red1 medium"> <?= $tradSubTitle1 ?></div>
        <div class="title__descr purple2 bold"><?= $tradSubTitle2 ?></div>
    </div>
    <div class="spacer"></div>
</header>