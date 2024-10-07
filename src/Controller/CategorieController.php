<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findBy([],["nom" => "ASC"]);
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

       // Méthode pour ajouter une catégorie
       #[Route('/categorie/ajouter', name: 'add_categorie')]
       public function add(Security $security,Request $request, EntityManagerInterface $entityManager): Response
       {
   
           // Vérification du rôle 'ROLE_ADMIN'
           if (!$security->isGranted('ROLE_ADMIN')) {
               // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
               return $this->render('session/errorPage.html.twig');     
           }
   
           $categorie = new Categorie();
           $form = $this->createForm(CategorieType::class,$categorie);
   
           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
               $entityManager->persist($categorie);
               $entityManager->flush();
   
               return $this->redirectToRoute('app_categorie');
           }
   
           return $this->render('categorie/add.html.twig', [
               'form' => $form->createView(),
           ]);
       }

    #[Route('/categorie/{id}', name: 'show_categorie')]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie

        ]);

    }
}
