<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\User;

use App\Form\User\Dto\UserDTO;
use App\Form\User\UserType;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    /** @test */
    public function submit_valid_data(): void
    {
        //self::markTestSkipped();
        $formData = [
            'email' => 'test@example.it',
            'accountStatus' => true,
        ];

        $objectToCompare = new UserDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(UserType::class, $objectToCompare);

        // ...populate $object properties with the data stored in $formData
        $object = new UserDTO();
        $object->email = 'test@example.it';
        $object->accountStatus = true;

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
