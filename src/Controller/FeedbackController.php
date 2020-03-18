<?php

namespace App\Controller;

use App\Entity\Feedback;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function index()
    {
        return $this->render('feedback/index.html.twig', [
            'controller_name' => 'FeedbackController',
        ]);
    }
    /**
     * Affiche le détail d'une feedback
     * @Route("/feedback/{id}", name="feedback_show", methods={"GET"})
     * @param feedback $feedback
     */
    public function show(feedback $feedback)
    {
    }

    /**
     * Traite la requête d'un formulaire de création de feedback
     * @Route("/feedback", name="feedback_create", methods={"POST"})
     */
    public function create()
    {
    }

    /**
     * Affiche le formulaire d'édition d'une feedback (GET)
     * Traite le formulaire d'édition d'une feedback (POST)
     * @Route("/feedback/{id}/edit", name="feedback_edit", methods={"GET", "POST"})
     * @param feedback $feedback
     */
    public function edit(Feedback $feedback)
    {
    }

    /**
     * Supprime une feedback
     * @Route("/feedback/{id}", name="feedback_delete", methods={"DELETE"})
     */
    public function delete(Feedback $feedback)
    {
    }
}
