<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Core\{Manager, Mysqli};
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    protected readonly Mysqli $db;
    protected readonly Manager $rm;
    protected readonly UserRepository $ur;

    public function setUp(): void
    {
        $this->db = new Mysqli();
        $this->rm = new Manager($this->db);
        $this->ur = $this->rm->getRepository(UserRepository::class);

        $this->db->connect();
    }

    public function testSetCookieLoginUserLogedMethod(): void
    {
        $clulSet = $this->ur->setCookieLoginUserLoged(
            1,
            '127.0.0.1',
            date('Y-m-d H:i:s')
        );

        $this->assertTrue($clulSet);
    }

    public function testGetCookieLoginUserDataMethod(): void
    {
        $clud = $this->ur->getCookieLoginUserData('USER', '');

        $this->assertEquals(1, $clud['user_id']);
        $this->assertEquals(false, $clud['user_admin']);
        $this->assertEquals(true, $clud['user_active']);
        $this->assertEquals('User', $clud['user_login']);
    }
}
