<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Psr\Log\LoggerInterface;

class TaskFixtures extends Fixture
{


    private Generator $faker;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->faker = Factory::create();
        $this->logger = $logger;
    }

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        while ($i < 10) {
            $task = new Task();
            $task->setTitle($this->faker->jobTitle());
            $task->setStatus($this->faker->boolean());
            $manager->persist($task);

            $i++;
        }
        $manager->flush();
    }
}

