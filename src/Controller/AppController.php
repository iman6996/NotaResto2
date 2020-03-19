<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app",methods={"GET"})
     */
    public function index()
    {

        $tenBestRestaurantsId = $this->getDoctrine()->getRepository(Feedback::class)->findBestTenRatings();

        $tenBestRestaurants = array_map(function($data) {
            return $this->getDoctrine()->getRepository(Restaurant::class)->find($data['restaurantId']);
        }, $tenBestRestaurantsId);

        return $this->render('app/index.html.twig', [
            'restaurants' => $tenBestRestaurants,
        ]);
    }
}
