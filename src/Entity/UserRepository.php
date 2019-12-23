<?php

declare(strict_types=1);

namespace App\Entity;

interface UserRepository
{
    public function save(User $user): void;

    public function update(User $user): void;

    public function delete(User $user): void;
}
