<?php

declare(strict_types=1);

namespace App\Form\User\Dto;

use App\Entity\UserId;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeUserPasswordDTO
{
    /** @var UserId */
    public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $plainPassword;
}
