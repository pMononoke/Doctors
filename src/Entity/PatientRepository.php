<?php

declare(strict_types=1);

namespace App\Entity;

interface PatientRepository
{
    public function save(Patient $patient): void;

    public function update(Patient $patient): void;

    public function delete(Patient $patient): void;

    public function nextIdentity(): PatientId;
}
