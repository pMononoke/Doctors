<?php

declare(strict_types=1);

namespace App\Tests\Support\Builder;

use App\Entity\User;
use App\Entity\UserId;

class UserBuilder implements BuilderInterface
{
    private const IRRELEVANT = 'irrelevant';
    private const GENDER_MALE = 'male';
    private const GENDER_FEMALE = 'female';

    /** @var UserId|null */
    private $id;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $firstName;

    /** @var string|null */
    private $lastName;

    /** @var bool|null */
    private $accountStatus;

    /** @var array|null */
    private $roles = [];

    /** @var \DateTimeImmutable|null */
    private $createAt;

    /** @var \DateTimeImmutable|null */
    private $updateAt;

    public function __construct(
        UserId $userId = null,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        bool $accountStatus = null,
        array $roles = null,
        \DateTimeImmutable $createdAt = null,
        \DateTimeImmutable $updatedAt = null
    ) {
        $this->id = $userId;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->accountStatus = $accountStatus;
        $this->roles = $roles;
        $this->createAt = $createdAt;
        $this->updateAt = $updatedAt;
    }

    /**
     * Create the builder.
     *
     * @return mixed
     */
    public static function create()
    {
        return new self(
            UserId::generate()
        );
    }

    /**
     * Build and return the object the builder takes care of.
     */
    public function build(): User
    {
        $user = new User();
        $this->email ? $user->setEmail($this->email) : '';
        $this->firstName ? $user->setFirstName($this->firstName) : '';
        $this->lastName ? $user->setLastName($this->lastName) : '';
        // default account status is disabled/false
        $this->accountStatus ? $user->setAccountStatus($this->accountStatus) : $user->setAccountStatus(false);
        $this->roles ? $user->setRoles((array) $this->roles) : $user->setRoles((array) ['ROLE_USER']);

        return $user;
    }

    public function withEmail(string $email): UserBuilder
    {
        $copy = $this->copy();
        $copy->email = $email;

        return $copy;
    }

    public function withFirstName(string $firstName): UserBuilder
    {
        $copy = $this->copy();
        $copy->firstName = $firstName;

        return $copy;
    }

    public function withLastName(string $lastName): UserBuilder
    {
        $copy = $this->copy();
        $copy->lastName = $lastName;

        return $copy;
    }

    public function withEnabledAccount(): UserBuilder
    {
        $copy = $this->copy();
        $copy->accountStatus = true;

        return $copy;
    }

    public function withDisabledAccount(): UserBuilder
    {
        $copy = $this->copy();
        $copy->accountStatus = false;

        return $copy;
    }

    public function withRoles(array $roles): UserBuilder
    {
        $copy = $this->copy();
        $copy->roles = $roles;

        return $copy;
    }

    private function copy(): UserBuilder
    {
        return new self(
            $this->id,
            $this->email,
            $this->firstName,
            $this->lastName,
            $this->accountStatus,
            $this->roles,
            $this->createAt,
            $this->updateAt
        );
    }
}
