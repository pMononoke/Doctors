<?php

declare(strict_types=1);

namespace App\Service;

interface PasswordGenerator
{
    public function generatepassword(): string;
}
