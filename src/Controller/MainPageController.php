<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\{Html, Token};
use App\Service\MainPageService;
use App\Validator\MainPageValidator;

class MainPageController
{
    public function mainPageAction(array $request): array
    {
        $html = new Html();
        $csrfToken = new Token();
        $mainPageValidator = new MainPageValidator($csrfToken);

        $mainPageService = new MainPageService(
            $html,
            $csrfToken,
            $mainPageValidator
        );

        $array = $mainPageService->mainPageAction(
            (string) ($request['lang'] ?? ''),
            (string) ($request['name'] ?? ''),
            (bool) ($request['submit'] ?? false),
            (string) ($request['token'] ?? '')
        );

        return $array;
    }
}
