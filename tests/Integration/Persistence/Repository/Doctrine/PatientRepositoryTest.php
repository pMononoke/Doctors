<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\Patient;
use App\Entity\PatientRepository;
use App\Tests\Support\Builder\PatientBuilder;
use App\Tests\Support\TestCase\DatabaseTestCase;

class PatientRepositoryTest extends DatabaseTestCase
{
    /** @var mixed|PatientRepository */
    private $repository;

    /** @var mixed */
    private $clock;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = self::$container->get('test.App\Repository\PatientRepository');
        $this->clock = self::$container->get('test.app.clock.system');
        parent::setUp();
    }

    /** @test */
    public function can_persist_a_patient(): void
    {
        $newPatient = $this->createPatient();

        $this->repository->save($newPatient);

        self::assertEquals(1, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_persist_multiple_patients(): void
    {
        $firstPatient = $this->createPatient();
        $this->repository->save($firstPatient);
        $secondPatient = $this->createPatient();
        $this->repository->save($secondPatient);
        $thridPatient = $this->createPatient();
        $this->repository->save($thridPatient);

        self::assertEquals(3, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_update_a_patient(): void
    {
        $newPatient = $this->createPatient();
        $this->repository->save($newPatient);

        $newPatient->setLastName('new lastname');
        $this->repository->update($newPatient);

        self::assertEquals(1, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_delete_a_patient(): void
    {
        $newPatient = $this->createPatient();
        $this->repository->save($newPatient);
        self::assertEquals(1, $this->countItem(Patient::class));

        $this->repository->delete($newPatient);
        self::assertEquals(0, $this->countItem(Patient::class));
    }

    private function createPatient(): Patient
    {
        $builder = PatientBuilder::create()
            ->withGender('male');

        return $builder->build();
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        $this->clock = null;
        parent::tearDown();
    }
}
