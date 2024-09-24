<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Categorie;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Categorie $categorie,SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findBy(['categorie' => $categorie],[],["nom" => "ASC"]);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
            'categorie' => $categorie
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,

        ]);

    }
}