<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Entity\Patient;
use App\Entity\PatientRepository;
use App\Form\Patient\Dto\PatientPersonalDataDTO;
use App\Form\Patient\Dto\RegisterPatientDTO;
use App\Service\PatientService;
use App\Tests\Support\Builder\PatientBuilder;
use App\Tests\Support\TestCase\DatabaseTestCase;

class PatientServiceTest extends DatabaseTestCase
{
    /** @var PatientService|mixed */
    private $patientService;

    /** @var PatientRepository|mixed */
    private $patientRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->patientService = self::$container->get('test.App\Service\PatientService');
        $this->patientRepository = self::$container->get('test.App\Repository\PatientRepository');
        parent::setUp();
    }

    /** @test */
    public function can_register_a_patient(): void
    {
        $patient = $this->createPatient();

        $this->patientService->RegisterPatient($patient);

        self::assertEquals(1, $this->countItem(Patient::class));
    }

    /** @test */
    public function can_register_a_patient_from_dto(): void
    {
        $newPatient = $this->createPatient();
        $registerPatientDTO = new RegisterPatientDTO();
        $patientPersonalDataDTO = PatientPersonalDataDTO::fromPatient($newPatient);
        $registerPatientDTO->patientPersonalData = $patientPersonalDataDTO;

        $this->patientService->RegisterPatientWithData($newPatient->getId(), $registerPatientDTO);

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
    public function can_update_a_patient(): void
    {
        $patient = $this->createPatient();
        $this->databaseManager()->save($patient);

        $patient->setLastName('new lastname');
        $this->patientService->update($patient);

        /** @var Patient $patientFromDatabase */
        $patientFromDatabase = $this->find(Patient::class, $patient->getId());
        self::assertEquals(1, $this->countItem(Patient::class));
        self::assertEquals('new lastname', $patientFromDatabase->getLastName());
    }

    private function createPatient(): Patient
    {
        $patientBuilder = PatientBuilder::create();

        $patient = $patientBuilder
            ->build();

        return $patient;
    }

    /** @test */
    public function can_delete_a_patient(): void
    {
        $patient = $this->createPatient();
        $this->databaseManager()->save($patient);

        $this->patientService->delete($patient);

        self::assertEquals(0, $this->countItem(Patient::class));
    }

    protected function tearDown(): void
    {
        $this->patientService = null;
        $this->patientRepository = null;
        parent::tearDown();
    }
}
