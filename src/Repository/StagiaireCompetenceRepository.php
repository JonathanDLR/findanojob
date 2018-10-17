<?php

namespace App\Repository;

use App\Entity\StagiaireCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StagiaireCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method StagiaireCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method StagiaireCompetence[]    findAll()
 * @method StagiaireCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StagiaireCompetence::class);
    }

//    /**
//     * @return StagiaireCompetence[] Returns an array of StagiaireCompetence objects
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
    public function findOneBySomeField($value): ?StagiaireCompetence
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
