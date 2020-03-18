<?php

namespace App\Controller;

use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{ 
    /** 
    * * Affiche la liste de toutes les villes 
     * @Route("/city", name="city_index",methods={"GET"})
     */
    public function index()
    {
        return $this->render('city/index.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }

    /**
     * Affiche le détail d'une ville 
     * @Route("/city/{id}", name="city_show", methods={"GET"})
     * @param City $city
     */
    public function show(City $city)
    {
    }

    /**
     * Traite la requête d'un formulaire de création d'une ville
     * @Route("/city/new", name="city_create", methods={"POST"})
     */
    public function create()
    {
    }
    /**
     * Affiche le formulaire d'édition d'une ville  (GET)
     * Traite le formulaire d'édition d'une ville  (POST)
     * @Route("/city/{id}/edit", name="city_edit", methods={"GET", "POST"})
     * @param City $city
     */
    public function edit(City $city)
    {
    }

    /**
     * Supprime une ville
     * @Route("/city/{id}", name="city_delete", methods={"DELETE"})
     * @param City $city
     */
    public function delete(City $city)
    {
    }
}
