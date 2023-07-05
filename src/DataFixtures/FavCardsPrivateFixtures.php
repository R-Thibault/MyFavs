<?php

namespace App\DataFixtures;

use App\Entity\FavCardsPrivate;
use App\Entity\Users;
use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class FavCardsPrivateFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = $manager->getRepository(Users::class)->findAll();
        $tags = $manager->getRepository(Tags::class)->findAll();

        foreach ($users as $user) {
            for ($i = 1; $i <= 10; $i++) {
                $favCardsPrivate = new FavCardsPrivate();
                $favCardsPrivate->setTitle($faker->sentence());
              $favCardsPrivate->setDescription($faker->paragraph());
              $favCardsPrivate->setLink($faker->url());
              $favCardsPrivate->setStatus('1');
              $favCardsPrivate->setAuthor($user);
              $counter = $faker->numberBetween(1, 3);
              for ($j = 1; $j <= $counter; $j++) {
                $favCardsPrivate->addTag($faker->randomElement($tags));
              };
              
              $favCardsPrivate->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months', 'now')));
                
                $manager->persist($favCardsPrivate);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TagsFixtures::class,
            UsersFixtures::class,
        ];
    }
}
