<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        $loader = new NativeLoader();
//        $objectSet = $loader->loadFile(__DIR__ . '/ORM/security-fixtures.yaml')->getObjects();
//        foreach($objectSet as $object)
//        {
//            $manager->persist($object);
//        }
//
//        $manager->flush();
    }
}
