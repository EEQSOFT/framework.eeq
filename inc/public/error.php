<?php

require_once dirname(__DIR__, 2) . '/config/config.php';

$code = (int) ($_GET['code'] ?? 404);
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>Error <?= $code ?></title>

        <style>
            body {
                margin: 30px;
            }

            h1, a, p {
                color: #000;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
                font-weight: bold;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
                line-height: 20px;
            }

            h1 {
                margin-bottom: 6px;
                font-size: 40px;
                line-height: 40px;
            }

            a:hover {
                color: #f00;
            }

            p {
                margin-bottom: 4px;
            }
        </style>
    </head>

    <body>
        <h1>Error <?= $code ?></h1>

        <p><a href="/">Back to the main page</a></p>
    </body>
</html>
