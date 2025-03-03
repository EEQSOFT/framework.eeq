<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Controller;
use App\Service\MainPageService;
use App\Validator\MainPageValidator;

class MainPageController extends Controller
{
    public function mainPageAction(array $request): array
    {
        $mainPageValidator = new MainPageValidator($this->csrfToken);

        $mainPageService = new MainPageService(
            $this,
            $this->html,
            $this->csrfToken,
            $mainPageValidator
        );

        return $mainPageService->mainPageAction(
            (string) ($request['lang'] ?? ''),
            (string) ($request['name'] ?? ''),
            (bool) ($request['submit'] ?? false),
            (string) ($request['token'] ?? '')
        );
    }
}
