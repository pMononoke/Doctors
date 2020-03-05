<?php

declare(strict_types=1);

namespace App\Entity;

interface DiseaseRepository
{
    public function save(Disease $diseases): void;

    public function update(Disease $diseases): void;

    public function delete(Disease $diseases): void;
}
