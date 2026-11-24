<?php

declare(strict_types=1);

namespace App\Core;

class Html
{
    public function prepareError(
        ?array $array,
        string $before = '',
        string $after = '<br>',
        string $beforeAll = '',
        string $afterAll = ''
    ): ?string {
        if (!is_array($array)) {
            return null;
        }

        $error = $beforeAll;

        foreach ($array as $key => $value) {
            $error .= $before . htmlspecialchars($value) . $after;
        }

        $error .= $afterAll . "\n";

        return $error;
    }

    public function preparePageNavigator(
        string $url,
        int $level,
        int $listLimit,
        int $count,
        int $levelLimit,
        string $before = '',
        string $after = '',
        string $beforeActive = '[',
        string $afterActive = ']',
        string $beforeAll = '',
        string $afterAll = ''
    ): ?string {
        if ($count <= $listLimit) {
            return null;
        }

        $minLevel = 1;
        $maxLevel = number_format($count / $listLimit, 0, '.', '');
        $number = number_format($count / $listLimit, 2, '.', '');
        $maxLevel = ($number > $maxLevel) ? $maxLevel + 1 : $maxLevel;
        $number = $level - $levelLimit;
        $fromLevel = ($number < $minLevel) ? $minLevel : $number;
        $number = $level + $levelLimit;
        $toLevel = ($number > $maxLevel) ? $maxLevel : $number;
        $previousLevel = $level - 1;
        $nextLevel = $level + 1;
        $url = htmlspecialchars($url);

        $pageNavigator = $beforeAll;

        if ($maxLevel > $levelLimit) {
            $pageNavigator .= ($level > $minLevel) ? $before . '<a href="'
                . $url . $minLevel . '">...</a>' . $after : '';
        }

        $pageNavigator .= ($level > $minLevel) ? $before . '<a href="'
            . $url . $previousLevel . '">&nbsp;&laquo&nbsp;</a>' . $after : '';

        for ($i = $fromLevel; $i <= $toLevel; $i++) {
            $pageNavigator .= ($i !== $level) ? $before . '<a href="' . $url
                . $i . '">&nbsp;' . $i . '&nbsp;</a>' . $after : $beforeActive
                . $i . $afterActive;
        }

        $pageNavigator .= ($level < $maxLevel) ? $before . '<a href="'
            . $url . $nextLevel . '">&nbsp;&raquo;&nbsp;</a>' . $after : '';

        if ($maxLevel > $levelLimit) {
            $pageNavigator .= ($level < $maxLevel) ? $before . '<a href="'
                . $url . $maxLevel . '">...</a>' . $after : '';
        }

        $pageNavigator .= $afterAll . "\n";

        return $pageNavigator;
    }
}
