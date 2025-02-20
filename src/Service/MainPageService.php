<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\{CsrfToken, Html};
use App\Validator\MainPageValidator;

class MainPageService
{
    protected Html $html;
    protected CsrfToken $csrfToken;
    protected MainPageValidator $mainPageValidator;

    public function __construct(
        Html $html,
        CsrfToken $csrfToken,
        MainPageValidator $mainPageValidator
    ) {
        $this->html = $html;
        $this->csrfToken = $csrfToken;
        $this->mainPageValidator = $mainPageValidator;
    }

    public function mainPageAction(
        string $lang,
        string $name,
        bool $submit,
        string $token
    ): array {
        if ($submit) {
            $this->mainPageValidator->validate($name, $token);

            if ($this->mainPageValidator->isValid()) {
                return [
                    'content' => 'main_page/name_info.php',
                    'active_menu' => 'main_page',
                    'title' => PAGE_INFO_TITLE,
                    'language' => LANGUAGE_NAME[LANGUAGE_ID[$lang]],
                    'name' => $name
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
