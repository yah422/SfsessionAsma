<?php

namespace App\Controller;

use App\Entity\Module;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/module/{id}', name: 'show_module')]
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', [
            'module' => $module,

        ]);

    }
}
