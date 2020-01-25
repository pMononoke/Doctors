<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\Patient;

use App\Form\Patient\Dto\PatientPersonalDataDTO;
use App\Form\Patient\PatientPersonalDataType;
use Symfony\Component\Form\Test\TypeTestCase;

class PatientPersonalDataTypeTest extends TypeTestCase
{
    private const IRRELEVANT = 'irrelevant';

    /** @test */
    public function submit_valid_data(): void
    {
        //self::markTestSkipped();
        $formData = [
            'firstName' => self::IRRELEVANT,
            'middleName' => self::IRRELEVANT,
            'lastName' => self::IRRELEVANT,
            'gender' => 2,
            //TODO add dateOfBirth
            //'dateOfBirth' => new \DateTimeImmutable('1970-01-01'),
            //'dateOfBirth[year]' => '1970-01-01',
            //'dateOfBirth[day]' => '01',
            //'dateOfBirth[month]' => '01',
        ];

        $objectToCompare = new PatientPersonalDataDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(PatientPersonalDataType::class, $objectToCompare);

        // ...populate $object properties with the data stored in $formData
        $object = new PatientPersonalDataDTO();
        $object->firstName = self::IRRELEVANT;
        $object->middleName = self::IRRELEVANT;
        $object->lastName = self::IRRELEVANT;
        $object->gender = 'female';
        //$object->dateOfBirth = new \DateTimeImmutable('1970-01-01');

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        //var_dump($objectToCompare);

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
