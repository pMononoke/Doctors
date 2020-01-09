<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\User;

use App\Form\User\Dto\RegisterUserDTO;
use App\Form\User\Dto\UserDTO;
use App\Form\User\Dto\UserProfileDTO;
use App\Form\User\RegisterUserType;
use Symfony\Component\Form\Test\TypeTestCase;

class RegisterUserTypeTest extends TypeTestCase
{
    /** @test */
    public function submit_valid_data(): void
    {
        self::markTestSkipped();
        $formData = [
            'email' => 'test@example.it',
            'firstName' => 'pippo',
            'lastName' => 'pippo',
        ];

        $objectToCompare = new RegisterUserDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(RegisterUserType::class, $objectToCompare);

        $object = new RegisterUserDTO();

        $object->user = new UserDTO();
        $object->user->email = 'test@example.it';
        $object->profile = new UserProfileDTO();
        $object->profile->firstName = 'pippo';
        $object->profile->lastName = 'pippo';
        // ...populate $object properties with the data stored in $formData

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
