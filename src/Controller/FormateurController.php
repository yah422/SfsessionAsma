<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\FormateurType;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    // Méthode pour afficher tous les formateurs
    #[Route('/formateur', name: 'app_formateur')]
    public function index(FormateurRepository $formateurRepository): Response
    {
        $formateurs = $formateurRepository->findAll();
        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs,
        ]);
    }

    // Méthode pour ajouter un formateur
    #[Route('/formateur/ajouter', name: 'add_formateur')]
    public function add(Security $security,Request $request, EntityManagerInterface $entityManager): Response
    {

        // Vérification du rôle 'ROLE_ADMIN'
        if (!$security->isGranted('ROLE_ADMIN')) {
            // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
            return $this->render('session/errorPage.html.twig');     
        }

        $formateur = new Formateur();
        $form = $this->createForm(FormateurType::class,$formateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_formateur');
        }

        return $this->render('formateur/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/formateur/{id}/edit", name:"formateur_edit")]
    public function edit(Security $security, Request $request, Formateur $formateur, EntityManagerInterface $entityManager, int $id): Response
    {
         // Vérification du rôle 'ROLE_ADMIN'
         if (!$security->isGranted('ROLE_ADMIN')) {
            // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
            return $this->render('stagiaire/errorPage.html.twig');     
            }

        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_formateur', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('formateur/edit.html.twig', [
            'formateur' => $formateur,
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer un formateur
    #[Route('/formateur/supprimer/{id}', name: 'delete_formateur', methods: ['DELETE'])]
    public function delete(Formateur $formateur, EntityManagerInterface $entityManager): RedirectResponse
    {
        // Suppression du formateur
        $entityManager->remove($formateur);
        $entityManager->flush();

        // Redirection vers la liste des formateurs après suppression
        return $this->redirectToRoute('app_formateur');
    }


    // Méthode pour afficher un formateur en particulier
    #[Route('/formateur/{id}', name: 'show_formateur')]
    public function show(Formateur $formateur): Response
    {
        return $this->render('formateur/show.html.twig', [
            'formateur' => $formateur,
        ]);
    }
}
