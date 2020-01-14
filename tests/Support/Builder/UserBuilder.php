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

    /** @var bool|null */
    private $accountStatus;

    /** @var \DateTimeImmutable|null */
    private $createAt;

    /** @var \DateTimeImmutable|null */
    private $updateAt;

    public function __construct(
        UserId $userId = null,
        ?string $email = null,
        bool $accountStatus = null,
        \DateTimeImmutable $createdAt = null,
        \DateTimeImmutable $updatedAt = null
    ) {
        $this->id = $userId;
        $this->email = $email;
        $this->accountStatus = $accountStatus;
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
        //TODO enabled doset work
        //!(null === $this->accountStatus) ?? $user->setAccountStatus($this->accountStatus);
        // default account status false
        $this->accountStatus ? $user->setAccountStatus($this->accountStatus) : $user->setAccountStatus(false);

        return $user;
    }

    public function withEmail(string $email): UserBuilder
    {
        $copy = $this->copy();
        $copy->email = $email;

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

    private function copy(): UserBuilder
    {
        return new self(
            $this->id,
            $this->email,
            $this->accountStatus,
            $this->createAt,
            $this->updateAt
        );
    }
}
