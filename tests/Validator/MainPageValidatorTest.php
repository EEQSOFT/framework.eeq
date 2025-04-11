<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use App\Core\CsrfToken;
use App\Validator\MainPageValidator;
use PHPUnit\Framework\TestCase;

class MainPageValidatorTest extends TestCase
{
    public function testMainPageValidator(): void
    {
        $csrfToken = $this->createMock(CsrfToken::class);
        $csrfToken->expects($this->exactly(3))
                  ->method('receiveToken')
                  ->will($this->returnValue($token = '1234567890'));

        $validator = new MainPageValidator($csrfToken);

        $validator->validate('Name', $token);
        $valid = $validator->isValid();

        $this->assertTrue($valid);

        $validator->validate('', $token);
        $valid = $validator->isValid();

        $this->assertFalse($valid);

        $validator->validate('123456789012345678901', $token);
        $valid = $validator->isValid();

        $this->assertFalse($valid);
    }
}
