<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    public $id;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $email;

    /**
     * Assert\NotBlank().
     *
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $roles;

    /**
     * Assert\NotBlank().
     *
     * @Assert\Length(min="1", max="100")
     *
     * @var string
     */
    public $password;

    public static function fromUser(User $user): self
    {
        $dto = new self();
        $dto->email = $user->getEmail();

        return $dto;
    }
}
