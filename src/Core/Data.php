<?php

declare(strict_types=1);

namespace App\Core;

class Data
{
    public function prepareInput(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $array[$key] = trim($value);
            }
        }

        return $array;
    }

    public function prepareOutput(array $array): array
    {
        foreach ($array as $key => $value) {
            if (
                preg_match('/^error([_0-9]*)$/', $key) !== 1
                && preg_match('/^page_navigator([_0-9]*)$/', $key) !== 1
                && is_string($value)
            ) {
                $array[$key] = htmlspecialchars($value);
            } elseif (is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    if (is_string($value2)) {
                        $array[$key][$key2] = htmlspecialchars($value2);
                    } elseif (is_array($value2)) {
                        foreach ($value2 as $key3 => $value3) {
                            if (is_string($value3)) {
                                $array[$key][$key2][$key3] =
                                    htmlspecialchars($value3);
                            }
                        }
                    }
                }
            }
        }

        return $array;
    }

    public static function prepareUtf8Text(string $text): string
    {
        $text = str_replace('ą', 'a', $text);
        $text = str_replace('ć', 'c', $text);
        $text = str_replace('ę', 'e', $text);
        $text = str_replace('ł', 'l', $text);
        $text = str_replace('ń', 'n', $text);
        $text = str_replace('ó', 'o', $text);
        $text = str_replace('ś', 's', $text);
        $text = str_replace('ź', 'z', $text);
        $text = str_replace('ż', 'z', $text);
        $text = str_replace('Ą', 'A', $text);
        $text = str_replace('Ć', 'C', $text);
        $text = str_replace('Ę', 'E', $text);
        $text = str_replace('Ł', 'L', $text);
        $text = str_replace('Ń', 'N', $text);
        $text = str_replace('Ó', 'O', $text);
        $text = str_replace('Ś', 'S', $text);
        $text = str_replace('Ź', 'Z', $text);
        $text = str_replace('Ż', 'Z', $text);

        return $text;
    }

    public static function prepareUrlText(string $text): string
    {
        $text = self::prepareUtf8Text($text);
        $text = strtolower($text);
        $text = str_replace(' ', '-', $text);
        $text = str_replace('_', '-', $text);
        $text = str_replace('&nbsp;', '-', $text);
        $text = str_replace('&lt;', '-', $text);
        $text = str_replace('&gt;', '-', $text);
        $text = str_replace('&laquo;', '-', $text);
        $text = str_replace('&raquo;', '-', $text);
        $text = str_replace('&copy;', 'c', $text);
        $text = str_replace('&reg;', 'r', $text);
        $text = str_replace('&amp;', '-', $text);
        $text = str_replace('&quot;', '', $text);
        $text = str_replace('&lsquo;', '', $text);
        $text = str_replace('&rsquo;', '', $text);
        $text = str_replace('&ldquo;', '', $text);
        $text = str_replace('&rdquo;', '', $text);
        $text = str_replace('&#034;', '', $text);
        $text = str_replace('&#038;', '-', $text);
        $text = str_replace('&#039;', '', $text);
        $text = str_replace('&#34;', '', $text);
        $text = str_replace('&#38;', '-', $text);
        $text = str_replace('&#39;', '', $text);
        $text = str_replace('&#8208;', '-', $text);
        $text = str_replace('&#8209;', '-', $text);
        $text = str_replace('&#8210;', '-', $text);
        $text = str_replace('&#8211;', '-', $text);
        $text = str_replace('&#8216;', '', $text);
        $text = str_replace('&#8217;', '', $text);
        $text = str_replace('&#8218;', '', $text);
        $text = str_replace('&#8219;', '', $text);
        $text = str_replace('&#8220;', '', $text);
        $text = str_replace('&#8221;', '', $text);
        $text = str_replace('&#8222;', '', $text);
        $text = str_replace('&#8223;', '', $text);
        $text = str_replace('&#8228;', '', $text);
        $text = str_replace('&#8229;', '', $text);
        $text = str_replace('&#8230;', '', $text);
        $text = str_replace('&', '-', $text);
        $text = str_replace('#', '', $text);
        $text = str_replace(';', '', $text);
        $text = str_replace(',', '', $text);
        $text = str_replace('.', '-', $text);
        $text = str_replace(':', '', $text);
        $text = str_replace('!', '', $text);
        $text = str_replace('?', '', $text);
        $text = str_replace("\\", '-', $text);
        $text = str_replace('|', '-', $text);
        $text = str_replace('(', '', $text);
        $text = str_replace(')', '', $text);
        $text = str_replace('[', '', $text);
        $text = str_replace(']', '', $text);
        $text = str_replace('{', '', $text);
        $text = str_replace('}', '', $text);
        $text = str_replace('<', '-', $text);
        $text = str_replace('>', '-', $text);
        $text = str_replace('=', '-', $text);
        $text = str_replace('+', '-', $text);
        $text = str_replace('/', '-', $text);
        $text = str_replace('*', '-', $text);
        $text = str_replace('^', '-', $text);
        $text = str_replace('%', '', $text);
        $text = str_replace('$', '', $text);
        $text = str_replace('@', '-', $text);
        $text = str_replace('~', '', $text);
        $text = str_replace('`', '', $text);
        $text = str_replace("'", '', $text);
        $text = str_replace('"', '', $text);

        while (strpos($text, '--') !== false) {
            $text = str_replace('--', '-', $text);
        }

        return $text;
    }
}
