<script async src="https://www.googletagmanager.com/gtag/js?id=G-E0EL35NJ59"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('set', '_anonymizeIp', true);

    gtag('config', 'G-E0EL35NJ59');
</script>

<?php $metaUrl = "https://manifeste.ensad.fr/$lang/$currentPage.php"; ?>

<!-- Primary Meta Tags -->
<title><?= $metaTitle ?></title>
<meta name="title" content="<?= $metaTitle ?>">
<meta name="description" content="<?= $tradMetaDescr ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $metaUrl ?>">
<meta property="og:title" content="<?= $metaTitle ?>">
<meta property="og:description" content="<?= $tradMetaDescr ?>">
<!-- <meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png%22%3E -->

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $metaUrl ?>">
<meta property="twitter:title" content="<?= $metaTitle ?>">
<meta property="twitter:description" content="<?= $tradMetaDescr ?>">
<!-- <meta property="twitter:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png%22%3E -->