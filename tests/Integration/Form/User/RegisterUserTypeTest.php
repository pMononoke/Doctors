<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\User;

use App\Form\User\Dto\RegisterUserDTO;
use App\Form\User\Dto\UserDTO;
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
            'firstName' => 'joe',
            'lastName' => 'doe',
            'accountStatus' => true,
        ];

        $objectToCompare = new RegisterUserDTO();
        $objectToCompare->user = new UserDTO();

        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(RegisterUserType::class, $objectToCompare);

        // ...populate $object properties with the data stored in $formData

        $user = new UserDTO();
        $user->email = 'test@example.it';
        $user->firstName = 'joe';
        $user->lastName = 'doe';
        $user->accountStatus = true;

        $registerUserDTO = new RegisterUserDTO();
        $registerUserDTO->user = $user;

        $object = $registerUserDTO;

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);
        var_dump($object);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
