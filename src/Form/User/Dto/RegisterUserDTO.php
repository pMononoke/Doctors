<?php

declare(strict_types=1);

namespace App\Form\User\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDTO
{
    /**
     * @Assert\Valid()
     *
     * @var UserDTO
     */
    public $user;
}
