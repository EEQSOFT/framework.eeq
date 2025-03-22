<?php

declare(strict_types=1);

use App\Core\Data;

function prepareUtf8Text(string $text): string {
    return Data::prepareUtf8Text($text);
}

function prepareUrlText(string $text): string {
    return Data::prepareUrlText($text);
}

function prepareHtmlText(string $text): string {
    return str_replace(array("\r\n", "\n", "\r"), '<br>', $text);
}

function prepareDescText(string $text): string {
    $text = str_replace(array("\r\n", "\n", "\r"), ' ', $text);

    if (strlen($text) > 200) {
        $text = substr($text, 0, 200);
        $text = substr($text, 0, strrpos($text, ' '));
        $text .= '...';
    }

    return $text;
}
