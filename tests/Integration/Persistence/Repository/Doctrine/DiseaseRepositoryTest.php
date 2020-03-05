<?php

declare(strict_types=1);

namespace App\Tests\Integration\Persistence\Repository\Doctrine;

use App\Entity\Disease;
use App\Entity\DiseaseRepository;
use App\Entity\Icd9\Icd9;
use App\Entity\Icd9\Icd9Code;
use App\Entity\Icd9\Icd9CodeDescription;
use App\Tests\Support\TestCase\DatabaseTestCase;

class DiseaseRepositoryTest extends DatabaseTestCase
{
    private const ICD_CODE = 'xxx.xx.xx';
    private const ICD_CODE_DESCRIPTION = 'icd code description';

    /** @var mixed|DiseaseRepository */
    private $repository;

    /** @var mixed */
    private $clock;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = self::$container->get('test.App\Repository\DiseaseRepository');
        $this->clock = self::$container->get('test.app.clock.system');
        parent::setUp();
    }

    /** @test */
    public function can_persist_a_desease(): void
    {
        $newDiseases = new Disease();
        $newDiseases->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString(self::ICD_CODE),
                Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION)
            )
        );

        $this->databaseManager()->save($newDiseases);

        self::assertEquals(1, $this->countItem(Disease::class));
        $allDiseaseFromDatabase = $this->findAll(Disease::class);
        /** @var Disease $diseaseFromDatabase */
        $diseaseFromDatabase = $allDiseaseFromDatabase[0];
        self::assertTrue($newDiseases->getDiseases()->equals($diseaseFromDatabase->getDiseases()));
    }

    /** @test */
    public function can_persist_multiple_diseases(): void
    {
        $firstDiseases = new Disease();
        $firstDiseases->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString(self::ICD_CODE),
                Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION)
            )
        );
        $secondDisease = new Disease();
        $secondDisease->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString('yyyy.yy'),
                Icd9CodeDescription::fromString('second code description')
            )
        );

        $this->repository->save($firstDiseases);
        $this->repository->save($secondDisease);

        self::assertEquals(2, $this->countItem(Disease::class));
    }

    /** @test */
    public function can_update_a_disease(): void
    {
        $aDisease = new Disease();
        $aDisease->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString(self::ICD_CODE),
                Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION)
            )
        );
        $this->databaseManager()->save($aDisease);

        $aDisease->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString('1111.11'),
                Icd9CodeDescription::fromString('updated description')
            )
        );

        $this->repository->update($aDisease);

        /** @var Disease $diseaseFromDatabase */
        $diseaseFromDatabase = $this->find(Disease::class, $aDisease->getId());
        self::assertEquals(1, $this->countItem(Disease::class));
        self::assertTrue($aDisease->getDiseases()->equals($diseaseFromDatabase->getDiseases()));
    }

    /** @test */
    public function can_delete_a_disease(): void
    {
        $newDiseases = new Disease();
        $newDiseases->setDiseases(
            $icd9 = new Icd9(
                Icd9Code::fromString(self::ICD_CODE),
                Icd9CodeDescription::fromString(self::ICD_CODE_DESCRIPTION)
            )
        );

        $this->databaseManager()->save($newDiseases);
        self::assertEquals(1, $this->countItem(Disease::class));

        $this->repository->delete($newDiseases);
        self::assertEquals(0, $this->countItem(Disease::class));
    }

    protected function tearDown(): void
    {
        $this->repository = null;
        $this->clock = null;
        parent::tearDown();
    }
}
