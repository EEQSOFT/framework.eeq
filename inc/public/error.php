<?php

require_once(__DIR__ . '/../../config/config.php');

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
                padding: 0;
                border: 0;
                background: #fff;
            }

            h1, a, p {
                width: auto;
                height: auto;
                margin: 0;
                padding: 0;
                border: 0;
                background: transparent;
                color: #000;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
                font-style: normal;
                font-weight: bold;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
                line-height: 22px;
                letter-spacing: 0;
            }

            h1, h1 a {
                margin-bottom: 6px;
                font-size: 40px;
                line-height: 38px;
            }

            a:hover {
                color: #ff0000;
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
