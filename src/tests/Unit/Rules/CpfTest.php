<?php

declare(strict_types=1);

namespace Tests\Unit\Rules;

use App\Rules\Cpf;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    #[DataProvider('validCpfs')]
    public function test_accepts_valid_cpfs(string $cpf): void
    {
        $this->assertTrue(Cpf::isValid($cpf));
    }

    #[DataProvider('invalidCpfs')]
    public function test_rejects_invalid_cpfs(string $cpf): void
    {
        $this->assertFalse(Cpf::isValid($cpf));
    }

    public static function validCpfs(): array
    {
        return [
            ['52998224725'],
            ['11144477735'],
            ['00000000191'],
        ];
    }

    public static function invalidCpfs(): array
    {
        return [
            'wrong first check digit' => ['52998224715'],
            'wrong second check digit' => ['52998224724'],
            'repeated digits' => ['11111111111'],
            'too short' => ['5299822472'],
            'too long' => ['529982247250'],
            'formatted' => ['529.982.247-25'],
            'empty' => [''],
        ];
    }
}
