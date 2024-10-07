<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    #[Route('/stagiaire/supprimer/{id}', name: 'delete_stagiaire', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request,Stagiaire $stagiaire, EntityManagerInterface $entityManager, CsrfTokenManagerInterface $csrfTokenManager,int $id): Response
    {

        if (!$stagiaire) {
            throw $this->createNotFoundException('No stagiaire found for id ' . $id);
        }

        // Vérifier le token CSRF
        if ($this->isCsrfTokenValid('delete_stagiaire', $request->request->get('_token'))) {
            // Si valide, on peut supprimer le stagiaire
            $entityManager->remove($stagiaire);
            $entityManager->flush();

            // Redirection après suppression
            return $this->redirectToRoute('app_stagiaire');
        }
        
        // Si le token est invalide, lever une exception
        throw $this->createAccessDeniedException('Token CSRF invalide.');

    }

    
    #[Route('/stagiaire/ajouter', name: 'add_stagiaire')]
    #[IsGranted('ROLE_ADMIN')]
    public function add(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Vérification du rôle 'ROLE_ADMIN'
        if (!$security->isGranted('ROLE_ADMIN')) {
        // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
        return $this->render('stagiaire/errorPage.html.twig');     
        }
        
        $stagiaire = new Stagiaire();
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            $this->addFlash('success', 'Stagiaire ajouté avec succès !');
            return $this->redirectToRoute('app_stagiaire');
        }

        return $this->render('stagiaire/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }  
    

#[Route("/stagiaire/{id}/edit", name:"stagiaire_edit")]
public function edit(Request $request, Stagiaire $stagiaire, EntityManagerInterface $entityManager, int $id): Response
{
    $form = $this->createForm(StagiaireType::class, $stagiaire);
    $form->handleRequest($request);
 
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
 
        return $this->redirectToRoute('app_stagiaire', [], Response::HTTP_SEE_OTHER);
    }
 
    return $this->render('stagiaire/edit.html.twig', [
        'stagiaire' => $stagiaire,
        'form' => $form->createView(),
    ]);
}
    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire,StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('stagiaire/show.html.twig', [
            'stagiaires' => $stagiaires,
            'stagiaire' => $stagiaire,


        ]);
    }
}
