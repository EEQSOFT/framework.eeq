<?php

declare(strict_types=1);

namespace App\Validator;

use App\Core\{CsrfToken, Error};

class MainPageValidator extends Error
{
    protected CsrfToken $csrfToken;

    public function __construct(CsrfToken $csrfToken)
    {
        parent::__construct();

        $this->csrfToken = $csrfToken;
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
