<?php

declare(strict_types=1);

namespace App\Form\User\Dto;

use App\Entity\User;
use App\Entity\UserId;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /** @var UserId */
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

    /**
     * Assert\NotBlank().
     *
     * @var bool
     */
    public $accountStatus;

    public static function fromUser(User $user): self
    {
        $dto = new self();
        $dto->email = $user->getEmail();
        $dto->accountStatus = $user->isActiveAccount();

        return $dto;
    }
}
