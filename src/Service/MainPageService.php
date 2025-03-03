<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\MainPageController;
use App\Core\{CsrfToken, Html};
use App\Repository\UserRepository;
use App\Validator\MainPageValidator;

class MainPageService
{
    public function __construct(
        protected readonly MainPageController $controller,
        protected readonly Html $html,
        protected readonly CsrfToken $csrfToken,
        protected readonly MainPageValidator $mainPageValidator
    ) {}

    public function mainPageAction(
        string $lang,
        string $name,
        bool $submit,
        string $token
    ): array {
        $rm = $this->controller->getManager();
        $ur = $rm->getRepository(UserRepository::class);

        if ($submit) {
            $this->mainPageValidator->validate($name, $token);

            if ($this->mainPageValidator->isValid()) {
                $userData = $ur->getCookieLoginUserData($name, '');

                return [
                    'content' => 'main_page/name_info.php',
                    'active_menu' => 'main_page',
                    'title' => PAGE_INFO_TITLE,
                    'language' => LANGUAGE_NAME[LANGUAGE_ID[$lang]],
                    'name' => $userData['user_login'] ?? $name
                ];
            }
        }

        return [
            'content' => 'main_page/main_page.php',
            'active_menu' => 'main_page',
            'title' => PAGE_MAIN_PAGE_TITLE,
            'desc' => WEBSITE_DESC,
            'keywords' => WEBSITE_KEYWORDS,
            'error' => $this->html->prepareError(
                $this->mainPageValidator->getError()
            ),
            'name' => $name,
            'token' => $this->csrfToken->generateToken()
        ];
    }
}
