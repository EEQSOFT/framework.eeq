<?php

declare(strict_types=1);

namespace App\Validator;

use App\Core\{CsrfToken, Error};

class MainPageValidator extends Error
{
    public function __construct(
        protected readonly CsrfToken $csrfToken
    ) {
        parent::__construct();
    }

    public function validate(string $name, string $token): void
    {
        if ($name === '') {
            $this->addError(FORM_MAIN_PAGE_NAME_MIN_MESSAGE);
        } elseif (strlen($name) > 20) {
            $this->addError(FORM_MAIN_PAGE_NAME_MAX_MESSAGE);
        }

        if ($token !== $this->csrfToken->receiveToken()) {
            $this->addError(FORM_TOKEN_INVALID);
        }
    }
}
