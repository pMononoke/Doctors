<?php

declare(strict_types=1);

namespace App\Tests\Integration\Form\User;

use App\Form\User\ChangeUserPasswordType;
use App\Form\User\Dto\ChangeUserPasswordDTO;
use Symfony\Component\Form\Test\TypeTestCase;

class ChangeUserPasswordTypeTest extends TypeTestCase
{
    /** @test */
    public function submit_valid_data(): void
    {
        self::markTestSkipped();
        $formData = [
            'plainPassword[first]' => 'test',
            'plainPassword[second]' => 'test',
        ];

        $objectToCompare = new ChangeUserPasswordDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ChangeUserPasswordType::class, $objectToCompare);

        $object = new ChangeUserPasswordDTO();

        $object->plainPassword = 'test';
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
