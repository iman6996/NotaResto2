<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Repository\RestaurantRepository;
use App\Repository\FeedbackRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class FeedbackFixtures extends Fixture implements DependentFixtureInterface
{
    private $restaurantRepository;
    private $feedbackRepository;

    public function __construct(RestaurantRepository $restaurantRepository, FeedbackRepository $feedbackRepository) {
        $this->restaurantRepository = $restaurantRepository;
        $this->feedbackRepository = $feedbackRepository;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        /**
         * On créée 7000 feedbacks initiales
         */
        for ($i=0; $i<7000; $i++) {
            $feedback = new Feedback();
            $feedback->setMessage( $faker->text(800) );
            $feedback->setRating( rand(0,5) );
            $feedback->setRestaurant( $this->restaurantRepository->find(rand(1, 1000)) );
            $manager->persist($feedback);
        }

        /**
         * On les enregistre en DB
         */
        $manager->flush();


        /**
         * On créée 3000 feedbacks enfants (dont le parent est une des feedback initiales)
         */
        for ($i=0; $i<3000; $i++) {
            $feedback = new Feedback();
            $feedback->setMessage( $faker->text(800) );
            $feedback->setRating( rand(0,5) );
            $feedback->setParent( $this->feedbackRepository->find(rand(1, 7000)) ); // On cherche un ID entre 1 et 7000 (un commentaire initial)
            $feedback->setRestaurant( $feedback->getParent()->getRestaurant() ); // On récupère le restaurant de la feedback parente
            $manager->persist($feedback);

        }

        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RestaurantFixtures::class,
        );
    }
}