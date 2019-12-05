<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Dto\PatientDTO;
use App\Service\PatientService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PatientServiceTest extends KernelTestCase
{
    private const IRRELEVANT_STRING = 'irrelevant';

    /** @var PatientService */
    private $patientService;

    /** var PersonRepository */
    private $personRepository;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        self::bootKernel();
        $this->patientService = self::$container->get('test.App\Service\PatientService');
        $this->personRepository = self::$container->get('test.App\Repository\PersonRepository');
    }

    /** @test */
    public function can_register_a_patient(): void
    {
        $patientDTO = new PatientDTO();
        $patientDTO->firstName = self::IRRELEVANT_STRING;
        $patientDTO->lastName = self::IRRELEVANT_STRING;
        $patientDTO->cin = self::IRRELEVANT_STRING;
        $patientDTO->cne = self::IRRELEVANT_STRING;
        $patientDTO->gender = self::IRRELEVANT_STRING;
        $patientDTO->cnss = self::IRRELEVANT_STRING;
        $patientDTO->cnsstype = self::IRRELEVANT_STRING;
        $patientDTO->resident = true;

        $this->patientService->RegisterPatient($patientDTO);

        self::assertEquals(1, $this->personRepository->counter());
    }

    protected function tearDown(): void
    {
        $this->patientService = null;
        $this->personRepository = null;
        parent::tearDown();
    }
}
