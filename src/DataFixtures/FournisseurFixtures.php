<?php
// src/DataFixtures/FournisseurFixtures.php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class FournisseurFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['fournisseur_group'];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); // Utilisez le générateur en français pour plus de précision

        // Configurer Faker pour générer des numéros de téléphone malgaches
        $faker->addProvider(new \Faker\Provider\fr_FR\PhoneNumber($faker));

        for ($i = 0; $i < 20; $i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNom($faker->company);
            $fournisseur->setEmail($faker->companyEmail);
            $fournisseur->setAdresse($faker->address);
            $fournisseur->setTelephone($faker->phoneNumber); // Utilise le générateur de téléphone malgache

            $manager->persist($fournisseur);
        }

        $manager->flush();
    }
}
