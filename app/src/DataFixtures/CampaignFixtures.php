<?php

namespace App\DataFixtures;

use App\Entity\Campaign;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CampaignFixtures extends Fixture
{

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0; $i <= 10; $i++) {
            $manager->persist($this->create());
        }

        $manager->flush();
    }

    private function create()
    {
        return new Campaign(
            $this->faker->company(),
            $this->faker->url(),
            $this->faker->dateTime(),
            $this->faker->dateTime()
        );
    }
}
