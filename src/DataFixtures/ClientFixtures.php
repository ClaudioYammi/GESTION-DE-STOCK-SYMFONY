<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ClientFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['client_group'];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $client = new Client();
            $client->setNom($faker->lastName);
            $client->setPrenom($faker->firstName);
            $client->setAdresse($faker->address);
            $client->setEmail($faker->email);
            $client->setTelephone($faker->phoneNumber);

            $manager->persist($client);
        }

        $manager->flush();
    }
}
