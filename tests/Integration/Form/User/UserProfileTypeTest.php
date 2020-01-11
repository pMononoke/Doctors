<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\User;

use App\Form\User\Dto\UserProfileDTO;
use App\Form\User\UserProfileType;
use Symfony\Component\Form\Test\TypeTestCase;

class UserProfileTypeTest extends TypeTestCase
{
    /** @test */
    public function submit_valid_data(): void
    {
        //self::markTestSkipped();
        $formData = [
            'firstName' => 'joe',
            'lastName' => 'doe',
        ];

        $objectToCompare = new UserProfileDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(UserProfileType::class, $objectToCompare);

        // ...populate $object properties with the data stored in $formData
        $object = new UserProfileDTO();
        $object->firstName = 'joe';
        $object->lastName = 'doe';

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
