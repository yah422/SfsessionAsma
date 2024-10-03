<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    // Afficher les stagiaires non inscrits dans une session

    public function findNonInscrits($session_id){

        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $qb = $sub;
        // séléctionner tous les stagiaires d'une sessions dont l'id est passé en paramétre
        $qb-> select('s')
            ->from('App\Entity\Stagiaire', 's')
            ->leftJoin('s.sessions','se')
            ->where('se.id = :id');

        $sub = $em->createQueryBuilder();
        // sélectionner tous le stagiaires qui ne sont pas (NOT IN) dans le résultat précédent
        // On obtient donc les stagiaires non inscrits pour une session définie
        $sub->select('st')
            ->from('App\Entity\Stagiaire','st')
            ->where($sub->expr()->notIn('st.id',$qb->getDQL()))
            // requête paramétrée
            ->setParameter('id',$session_id)
            // trier la liste des stagiaires sur le nom de famille
            ->orderBy('st.nom');

        // renvoyer le résultat
        $query = $sub->getQuery();
        return $query->getResult();

    }

    public function findNonProgrammes($session_id)
    {
        // Récupérer l'EntityManager
        $em = $this->getEntityManager();
        $subQuery = $em->createQueryBuilder();

        // Sélectionner tous les modules associés à la session
        $subQuery->select('m')
            ->from('App\Entity\Module', 'm')
            ->leftJoin('m.programmes', 'mp')
            ->where('mp.session = :id');
    
        // Sélectionner tous les modules qui ne sont pas associés à la session
        $mainQuery = $em->createQueryBuilder();


        $mainQuery->select('mt')
            ->from('App\Entity\Module', 'mt')
            ->where($mainQuery->expr()->notIn('mt.id', $subQuery->getDQL()))
            ->setParameter('id',$session_id)
            ->orderBy('mt.nom', 'ASC');
    
        // Renvoyer le résultat
        $query = $mainQuery->getQuery();
        return $query->getResult();
    }
    
    
//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
