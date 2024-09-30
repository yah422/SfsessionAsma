<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $moduleRepository): Response
    {
        $modules = $moduleRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }

    #[Route('/module', name: 'add_module')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('app_module');
        }

        return $this->render('module/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/module/{id}', name: 'show_module')]
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', [
            'module' => $module,

        ]);

    }
}
