<?php if (($array['desc'] ?? '') === '') { ?>
    <meta name="description" content="<?= WEBSITE_DESC ?>">
<?php } else { ?>
    <meta name="description" content="<?= prepareDescText($array['desc']) ?>">
<?php } ?>

<?php if (($array['keywords'] ?? '') !== '') { ?>
    <meta name="keywords" content="<?= $array['keywords'] ?>">
<?php } ?>

<meta name="robots" content="all">
