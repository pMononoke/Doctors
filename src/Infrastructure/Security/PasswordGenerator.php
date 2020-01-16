<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Service\PasswordGenerator as PasswordGeneratorPort;
use RandomLib\Factory as RandomLibFactory;
use SecurityLib\Strength;

class PasswordGenerator implements PasswordGeneratorPort
{
    private static $DIGITS = '0123456789';
    private static $LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private static $STRONG_THRESHOLD = 20;
    private static $SYMBOLS = '/"`!?$?%^&*()_-+={[}]:;@\'~#|\\<,>.?\//';
    private static $VERY_STRONG_THRESHOLD = 40;

    public function generatepassword(): string
    {
        return $this->generateStrongPassword();
    }

    public function generateStrongPassword(): string
    {
        $password = '';

        $factory = new RandomLibFactory();
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        $isStrong = false;

        $index = 0;

        while (!$isStrong) {
            $opt = $generator->generateInt(0, 3);

            switch ($opt) {
                case 0:
                    $index = $generator->generateInt(0, strlen(self::$LETTERS) - 1);
                    $password .= substr(self::$LETTERS, $index, $index + 1);
                    break;

                case 1:
                    $index = $generator->generateInt(0, strlen(self::$LETTERS) - 1);
                    $password .= strtolower(substr(self::$LETTERS, $index, $index + 1));
                    break;

                case 2:
                    $index = $generator->generateInt(0, strlen(self::$DIGITS) - 1);
                    $password .= substr(self::$DIGITS, $index, $index + 1);
                    break;

                case 3:
                    $index = $generator->generateInt(0, strlen(self::$SYMBOLS) - 1);
                    $password .= substr(self::$SYMBOLS, $index, $index + 1);
                    break;
            }

            if (strlen($password) >= 7) {
                $isStrong = $this->isStrong($password);
            }
        }

        return $password;
    }

    public function isStrong(string $plainTextPassword): bool
    {
        return $this->calculatePasswordStrength($plainTextPassword) >= self::$STRONG_THRESHOLD;
    }

    public function isVeryStrong(string $plainTextPassword): bool
    {
        return $this->calculatePasswordStrength($plainTextPassword) >= self::$VERY_STRONG_THRESHOLD;
    }

    public function isWeak(string $plainTextPassword): bool
    {
        return $this->calculatePasswordStrength($plainTextPassword) < self::$STRONG_THRESHOLD;
    }

    private function calculatePasswordStrength(string $plainTextPassword): int
    {
        $strength = 0;

        $length = strlen($plainTextPassword);

        if ($length > 7) {
            $strength += 10;
            // bonus: one point each additional
            $strength += ($length - 7);
        }

        $digitCount = $letterCount = $lowerCount = $upperCount = $symbolCount = 0;

        for ($idx = 0; $idx < $length; ++$idx) {
            $ch = $plainTextPassword[$idx];

            if (ctype_alnum($ch)) {
                ++$letterCount;
                if (ctype_upper($ch)) {
                    ++$upperCount;
                } else {
                    ++$lowerCount;
                }
            } elseif (ctype_digit($ch)) {
                ++$digitCount;
            } else {
                ++$symbolCount;
            }
        }

        $strength += ($upperCount + $lowerCount + $symbolCount);

        // bonus: letters and digits
        if ($letterCount >= 2 && $digitCount >= 2) {
            $strength += ($letterCount + $digitCount);
        }

        return $strength;
    }
}
