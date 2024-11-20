<?php

use App\Core\Data;

function prepareUtf8Text($text) {
    return Data::prepareUtf8Text((string) $text);
}

function prepareUrlText($text) {
    return Data::prepareUrlText((string) $text);
}

function prepareHtmlText($text) {
    return str_replace(array("\r\n", "\n", "\r"), '<br>', $text);
}

function prepareDescText($text) {
    $text = str_replace(array("\r\n", "\n", "\r"), ' ', $text);

    if (strlen($text) > 200) {
        $text = substr($text, 0, 200);
        $text = substr($text, 0, strrpos($text, ' '));
        $text .= '...';
    }

    return $text;
}
