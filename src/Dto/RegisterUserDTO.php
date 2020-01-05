<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDTO
{
    /** @Assert\Valid() */
    public $user;

    /** @Assert\Valid() */
    public $profile;

    /** @Assert\IsTrue() */
    public $confirm;
}
