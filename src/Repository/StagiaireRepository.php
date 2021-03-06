<?php

namespace App\Repository;

use App\Entity\Stagiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stagiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaire[]    findAll()
 * @method Stagiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stagiaire::class);
    }

    public function findRegion()
    {
        $req = $this->createQueryBuilder('e')
            ->select('e.region')
            ->getQuery();
        
        $test = $req->execute();

        $response = [];

        foreach($test as $key) {
            foreach($key as $value) {
                array_push($response, $value);
            }            
        }

        return $response;
    }

    public function findStagiaire($region)
    {
        $req = $this->createQueryBuilder('e')
            // ->select('e.nom', 'e.id')
            ->where('e.region = ?1')
            // ->andWhere('e.date_debut < ?2')
            ->setParameter(1, $region)
            // ->setParameter(2, $dateDebut)
            ->getQuery()
            ->getResult();

        return $req;
    }

//    /**
//     * @return Stagiaire[] Returns an array of Stagiaire objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stagiaire
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
