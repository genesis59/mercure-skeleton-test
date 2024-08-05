<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 40; $i++) {
            $user = new User();
            $user->setUsername("user$i");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setEmail("email$i@gmail.com");
            $user->setFirstName("User$i");
            $user->setLastName("User$i");
            $user->setBiography("Bio$i");
            $user->setLastOnline(new \DateTime());
            $this->addReference("user-$i", $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
