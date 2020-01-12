<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\Patient;
use App\Entity\PatientId;
use App\Entity\PatientRepository;
use App\Tests\Support\Builder\PatientBuilder;
use App\Tests\Support\TestCase\DatabaseTestCase;

class PatientRepositoryTest extends DatabaseTestCase
{
    private const FIRST_NAME = 'Arthur';
    private const MIDDLE_NAME = 'C.';
    private const LAST_NAME = 'Clark';
    private const GENDER = 'male';
    private const DATE_OF_BIRTH = '16-12-1917';

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
        $newPatient = $this->createPatientArthurClarke();

        $this->databaseManager()->save($newPatient);

        /** @var Patient $patientFromDatabase */
        $patientFromDatabase = $this->find(Patient::class, $newPatient->getId());
        self::assertEquals(1, $this->countItem(Patient::class));
        self::assertEquals($newPatient->getFirstName(), $patientFromDatabase->getFirstName());
        self::assertEquals($newPatient->getMiddleName(), $patientFromDatabase->getMiddleName());
        self::assertEquals($newPatient->getLastName(), $patientFromDatabase->getLastName());
        self::assertEquals($newPatient->getGender(), $patientFromDatabase->getGender());
        self::assertEquals($newPatient->getDateOfBirth(), $patientFromDatabase->getDateOfBirth());
    }

    /** @test */
    public function can_persist_multiple_patients(): void
    {
        $firstPatient = $this->createPatient();
        $secondPatient = $this->createPatient();
        $thridPatient = $this->createPatient();

        $this->repository->save($firstPatient);
        $this->repository->save($secondPatient);
        $this->repository->save($thridPatient);

        self::assertEquals(3, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_update_a_patient(): void
    {
        $newPatient = $this->createPatient();
        $this->databaseManager()->save($newPatient);
        $newPatient->setFirstName(self::FIRST_NAME);
        $newPatient->setMiddleName(self::MIDDLE_NAME);
        $newPatient->setLastName(self::LAST_NAME);
        $newPatient->setGender(self::GENDER);
        $newPatient->setDateOfBirth(new \DateTimeImmutable(self::DATE_OF_BIRTH));

        $this->repository->update($newPatient);

        /** @var Patient $patientFromDatabase */
        $patientFromDatabase = $this->find(Patient::class, $newPatient->getId());
        self::assertEquals(1, $this->countItem(Patient::class));
        self::assertEquals($newPatient->getFirstName(), $patientFromDatabase->getFirstName());
        self::assertEquals($newPatient->getMiddleName(), $patientFromDatabase->getMiddleName());
        self::assertEquals($newPatient->getLastName(), $patientFromDatabase->getLastName());
        self::assertEquals($newPatient->getGender(), $patientFromDatabase->getGender());
        self::assertEquals($newPatient->getDateOfBirth(), $patientFromDatabase->getDateOfBirth());
    }

    /** @test */
    public function can_delete_a_patient(): void
    {
        $newPatient = $this->createPatient();
        $this->databaseManager()->save($newPatient);
        self::assertEquals(1, $this->countItem(Patient::class));

        $this->repository->delete($newPatient);
        self::assertEquals(0, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_generate_a_new_identity_for_patient(): void
    {
        $identity = $this->repository->nextIdentity();

        self::assertInstanceOf(PatientId::class, $identity);
    }

    private function createPatient(): Patient
    {
        $builder = PatientBuilder::create()
            ->withGender('male');

        return $builder->build();
    }

    private function createPatientArthurClarke(): Patient
    {
        $builder = PatientBuilder::create()
            ->withFirstName(self::FIRST_NAME)
            ->withMiddleName(self::MIDDLE_NAME)
            ->withLastName(self::LAST_NAME)
            ->withGender('male')
            ->withDateOfBirth(new \DateTimeImmutable(self::DATE_OF_BIRTH));

        return $builder->build();
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        $this->clock = null;
        parent::tearDown();
    }
}
