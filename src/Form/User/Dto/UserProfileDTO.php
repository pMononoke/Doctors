<?php

declare(strict_types=1);

namespace App\Form\User\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class UserProfileDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $lastName;
}
