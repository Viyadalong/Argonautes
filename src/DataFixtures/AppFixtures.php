<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $member1 = new Member();
        $member1->setName('Eleftheria');
        $manager->persist($member1);

        $member2 = new Member();
        $member2->setName('Gennadios');
        $manager->persist($member2);

        $manager->flush();
    }
}