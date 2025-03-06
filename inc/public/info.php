<?php

require_once(__DIR__ . '/../../config/config.php');
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title><?= $title ?></title>

        <style>
            body {
                margin: 30px;
            }

            h1, p {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
                text-align: center;
                line-height: 20px;
            }

            h1 {
                margin-bottom: 6px;
                font-size: 40px;
                text-transform: uppercase;
                line-height: 40px;
            }

            p {
                margin-bottom: 4px;
            }
        </style>
    </head>

    <body>
        <h1><?= $title ?></h1>

        <p><?= $message ?></p>
    </body>
</html>
