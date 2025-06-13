<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Repository;

class UserRepository extends Repository
{
    public function setCookieLoginUserLoged(
        int $user,
        string $ip,
        string $date
    ): bool {
        $this->database->prepare(
            'UPDATE `user` u
            SET u.`user_ip_loged` = :ip, u.`user_date_loged` = :date
            WHERE u.`user_id` = :user'
        );

        $parameters = [
            'user' => $user,
            'ip' => $ip,
            'date' => $date
        ];

        return $this->database->execute($parameters);
    }

    public function getCookieLoginUserData(
        string $login,
        string $password
    ): array {
        $array = [];

        $stmt = $this->database->prepare(
            'SELECT u.`user_id`, u.`user_admin`, u.`user_active`,
                u.`user_login` FROM `user` u
            WHERE u.`user_login_canonical` = :login_canonical
                AND u.`user_password` = :password'
        );

        $parameters = [
            'login_canonical' => strtolower($login),
            'password' => $password
        ];

        $this->database->execute($parameters);

        foreach ($stmt as $row) {
            $array['user_id'] = (int) $row['user_id'];
            $array['user_admin'] = (bool) $row['user_admin'];
            $array['user_active'] = (bool) $row['user_active'];
            $array['user_login'] = $row['user_login'];
        }

        return $array;
    }
}
