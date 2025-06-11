<?php

declare(strict_types=1);

namespace App\Validator;

use App\Core\{CsrfToken, ErrorValidator};

class MainPageValidator extends ErrorValidator
{
    public function __construct(
        protected readonly CsrfToken $csrfToken
    ) {
        parent::__construct();
    }

    public function validate(array $array): void
    {
        list($name, $token) = $array;

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
