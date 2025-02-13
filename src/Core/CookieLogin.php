<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Controller;
use App\Repository\UserRepository;

class CookieLogin extends Controller
{
    public function setCookieLogin(): void
    {
        if (
            ($_SESSION['user'] ?? '') === ''
            && ($_COOKIE['cookie_login'] ?? '') !== ''
        ) {
            $this->setSessionLogin();
        }
    }

    private function setSessionLogin(): void
    {
        $rm = $this->getManager();
        $ur = $rm->getRepository(UserRepository::class);

        $cookie = explode(';', $_COOKIE['cookie_login']);

        $cookieLoginUserData = $ur->getCookieLoginUserData(
            $cookie[0] ?? '',
            $cookie[1] ?? ''
        );

        if ($cookieLoginUserData['user_active'] ?? false) {
            $cookieLoginUserLogedSet = $ur->setCookieLoginUserLoged(
                $cookieLoginUserData['user_id'],
                $this->config->getRemoteAddress(),
                $this->config->getDateTimeNow()
            );

            if ($cookieLoginUserLogedSet) {
                $_SESSION['id'] = $cookieLoginUserData['user_id'];
                $_SESSION['admin'] = $cookieLoginUserData['user_admin'];
                $_SESSION['user'] = $cookieLoginUserData['user_login'];
            }
        }
    }
}
