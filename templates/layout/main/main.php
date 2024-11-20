<?php

ob_start();
?>

<!DOCTYPE html>

<html lang="<?= $lang ?>">
    <head>
        <?php include('head.php'); ?>
    </head>

    <body>
        <div id="page">
            <header id="header">
                <?php include('header.php'); ?>
            </header>

            <nav id="menu">
                <?php include('menu.php'); ?>
            </nav>

            <section id="content">
                <?php include('content.php'); ?>
            </section>

            <footer id="footer">
                <?php include('footer.php'); ?>
            </footer>
        </div>

        <?php include('foot.php'); ?>
    </body>
</html>

<?php
ob_end_flush();
