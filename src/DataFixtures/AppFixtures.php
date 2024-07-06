<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public static function getGroups(): array
    {
        return ['User_group'];
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('ratovondriakakygo@gmail.com');
        $user->setPseudo('Administrateur');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setIsVerified(true);
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                'administrateur2024'
            )
        );

        $manager->persist($user);
        $manager->flush();
    }
}
