<?php

declare(strict_types=1);

namespace App\Tests\Validator;

use App\Core\CsrfToken;
use App\Validator\MainPageValidator;
use PHPUnit\Framework\TestCase;

class MainPageValidatorTest extends TestCase
{
    protected readonly string $token;
    protected readonly CsrfToken $csrfToken;
    protected readonly MainPageValidator $validator;

    public function setUp(): void
    {
        $this->token = '1234567890';

        $this->csrfToken = $this->createMock(CsrfToken::class);
        $this->csrfToken->expects($this->once())
                        ->method('receiveToken')
                        ->will($this->returnValue($this->token));

        $this->validator = new MainPageValidator($this->csrfToken);
    }

    public function testRegularNameParameterIsValid(): void
    {
        $this->validator->validate('Name', $this->token);
        $valid = $this->validator->isValid();

        $this->assertTrue($valid);
    }

    public function testEmptyNameParameterIsNotValid(): void
    {
        $this->validator->validate('', $this->token);
        $valid = $this->validator->isValid();

        $this->assertFalse($valid);
    }

    public function testTooLongNameParameterIsNotValid(): void
    {
        $this->validator->validate('123456789012345678901', $this->token);
        $valid = $this->validator->isValid();

        $this->assertFalse($valid);
    }
}
