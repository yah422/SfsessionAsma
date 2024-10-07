<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Categorie;
use App\Entity\Programme;
use App\Form\SessionType;
use App\Form\ProgrammeType;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use Symfony\Component\Form\FormError;
use App\Repository\ProgrammeRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
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

    #[Route('/session/add', name: 'app_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Vérification du rôle 'ROLE_ADMIN'
        if (!$security->isGranted('ROLE_ADMIN')) {
            // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
            return $this->render('session/errorPage.html.twig');     
        }
    
        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les dates depuis l'objet de session
            $dateDebut = $session->getDateDebut();
            $dateFin = $session->getDateFin();
            
            // Vérifier que la date de début est antérieure à la date de fin
            if ($dateDebut > $dateFin) {
                // Ajouter un message d'erreur
                $form->addError(new FormError('La date de début doit être antérieure à la date de fin.'));
            } else {
                // Vérifier que le nombre de places est un nombre valide
                if (!is_numeric($session->getNbrePlace()) || $session->getNbrePlace() < 0) {
                    $form->addError(new FormError('Le nombre de places doit être un nombre valide et positif.'));
                } else {
                    // Persister la session si toutes les validations passent
                    $entityManager->persist($session);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('app_session');
                }
            }
        }
        
        // Rendre la vue avec le formulaire
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
            'nonProgrammes' => [],  // Assurez-vous de définir cette variable
            'nonInscrits' => [],     // Assurez-vous de définir cette variable
        ]);
    }
    
    

    
    #[Route("/session/{id}/edit", name:"session_edit")]
    public function edit(Security $security, Request $request, Session $session, EntityManagerInterface $entityManager, int $id): Response
    {
         // Vérification du rôle 'ROLE_ADMIN'
         if (!$security->isGranted('ROLE_ADMIN')) {
            // Rediriger vers une page d'erreur si l'utilisateur n'a pas le rôle 'ROLE_ADMIN'
            return $this->render('stagiaire/errorPage.html.twig');     
            }

        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_session', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('session/edit.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/session/supprimer/{id}', name: 'delete_session', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, CsrfTokenManagerInterface $csrfTokenManager, Session $session, EntityManagerInterface $entityManager,int $id): Response
    {
        if (!$session) {
            throw $this->createNotFoundException('No session found for id ' . $id);
        }
     
        // Vérifier le token CSRF
        if ($this->isCsrfTokenValid('delete_session', $request->request->get('_token'))) {
            // Si valide, on peut supprimer la session
            $entityManager->remove($session);
            $entityManager->flush();

            // Redirection après suppression
            return $this->redirectToRoute('app_session');
        }
     
        // Si le token est invalide, lever une exception
        throw $this->createAccessDeniedException('Token CSRF invalide.');
        
    }

    #[Route('/session/{id}/removeProgramme/{programmeId}', name: 'app_removeProgramme')]
    public function removeProgramme(int $id, int $programmeId, SessionRepository $sessionRepository, ProgrammeRepository $programmeRepository, EntityManagerInterface $entityManager): Response
    {
        // Recherche de la session par ID
        $session = $sessionRepository->find($id);
    
        // Vérification si la session existe
        if (!$session) {
            throw $this->createNotFoundException('Session non trouvée.');
        }
    
        // Recherche du programme par ID
        $programme = $programmeRepository->find($programmeId);
    
        // Vérification si le programme existe et est bien lié à la session
        if (!$programme || !$session->getProgrammes()->contains($programme)) {
            throw $this->createNotFoundException('Programme non trouvé ou non associé à cette session.');
        }
    
        // Suppression du programme
        $session->removeProgramme($programme); 
        $entityManager->remove($programme);
        $entityManager->flush();
    
        // Redirection vers la page de la session
        return $this->redirectToRoute("show_session", ['id' => $id]);
    }

    
    
    #[Route('/session/{id}/removeStagiaire/{stagiaireId}', name: 'app_removeStagiaire')]
    public function removeStagiaire(int $id, int $stagiaireId, SessionRepository $sessionRepository, StagiaireRepository $stagiaireRepository, EntityManagerInterface $entityManager): Response
    {
        // Recherche de la session par ID
        $session = $sessionRepository->find($id);
        
        // Vérification si la session existe
        if (!$session) {
            throw $this->createNotFoundException('Session non trouvée.');
        }
    
        // Recherche du stagiaire par ID
        $stagiaire = $stagiaireRepository->find($stagiaireId);
    
        // Vérification si le stagiaire existe et est bien inscrit à la session
        if (!$stagiaire || !$session->getStagiaires()->contains($stagiaire)) {
            throw $this->createNotFoundException('Stagiaire non trouvé ou non inscrit à cette session.');
        }
    
        // Suppression du stagiaire de la session
        $session->removeStagiaire($stagiaire);
    
        // Enregistrement des modifications
        $entityManager->persist($session);
        $entityManager->flush();
    
        // Redirection vers la page de la session
        return $this->redirectToRoute("show_session", ['id' => $id]);
    }
    
    #[Route('/session/{id}/addStagiaire/{stagiaireId}', name: 'app_addStagiaire')]
public function addStagiaire(int $id, int $stagiaireId, SessionRepository $sessionRepository, StagiaireRepository $stagiaireRepository, EntityManagerInterface $entityManager): Response
{
    // Recherche de la session par ID
    $session = $sessionRepository->find($id);
    
    // Vérification si la session existe
    if (!$session) {
        throw $this->createNotFoundException('Session non trouvée.');
    }

    // Recherche du stagiaire par ID
    $stagiaire = $stagiaireRepository->find($stagiaireId);

    // Vérification si le stagiaire existe
    if (!$stagiaire) {
        throw $this->createNotFoundException('Stagiaire non trouvé.');
    }

    // Vérifie si le stagiaire n'est pas déjà inscrit à la session
    if ($session->getStagiaires()->contains($stagiaire)) {
        $this->addFlash('warning', 'Ce stagiaire est déjà inscrit à la session.');
    } else {
        // Ajout du stagiaire à la session
        $session->addStagiaire($stagiaire);
        
        // Persistance et enregistrement des modifications
        $entityManager->persist($session);
        $entityManager->flush();
        
        $this->addFlash('success', 'Stagiaire ajouté avec succès à la session.');
    }

    // Redirection vers la fiche de la session
    return $this->redirectToRoute('show_session', ['id' => $id]);
}


    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, SessionRepository $sr, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les stagiaires non inscrits dans la session
        $nonInscrits = $sr->findNonInscrits($session->getId());
        
        // Récupérer les modules non programmés dans la session
        $nonProgrammes = $sr->findNonProgrammes($session->getId());
        
        // Créer un nouveau programme (ou le formulaire approprié)
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        
        // Gestion du formulaire
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Associer le programme à la session
            $programme->setSession($session);
            $entityManager->persist($programme);
            $entityManager->flush();
            $programme->setModule($data-> getModule());
            $programme->setDuree($data-> getDuree());
            $programme->setSession($session);
            
            // Rediriger après l'ajout du programme
            return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        }

        // Renvoyer les résultats à la vue
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'nonInscrits' => $nonInscrits,
            'nonProgrammes' => $nonProgrammes,
            'form' => $form->createView(), // Utiliser form
        ]);
    }

    
    
}
