<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }


    
    /*public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }*/

    /**
     * @return Stage[] Returns an array of Stage objects
     */
    
    public function findStagesByNomEntreprise($nom)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise','e')
            ->where('e.nom = :nom')
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Stage[] Returns an array of Stage objects
     */
    
    public function findAllStagesEntreprise()
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite->createQuery('SELECT s,e FROM App\Entity\Stage s JOIN s.entreprise e');

        return $requete->execute();
    }

    /**
     * @return Stage[] Returns an array of Stage objects
     */

    public function findStageByNomFormations($nom)
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite->createQuery('SELECT s,f FROM App\Entity\Stage s JOIN s.formations f WHERE f.nomCourt = :nom');

        $requete->setParameter('nom', $nom);

        return $requete->execute();
    }
    

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
