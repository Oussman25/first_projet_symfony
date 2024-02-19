<?php namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Shoes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // create 20 shoes!
        for ($i = 0; $i < 20; $i++) {
            $shoe = new Shoes();
            $shoe->setName($this->faker->word());
            $shoe->setPrice(rand(10, 100));
            $shoe->setImage('img'. $i. '.jpg');
            $manager->persist($shoe);
        }

        $manager->flush();
    }
}
