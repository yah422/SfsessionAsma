<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Categorie;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findBy([], ["dateDebut" => "ASC"]);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
            
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(ModuleRepository $moduleRepository,Session $session): Response
    {
        $modules = $moduleRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'modules' => $modules,
            'module' => 'module',

        ]);

    }
}
