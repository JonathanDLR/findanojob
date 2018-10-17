<?php

namespace App\Repository;

use App\Entity\OffreCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OffreCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreCompetence[]    findAll()
 * @method OffreCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OffreCompetence::class);
    }

//    /**
//     * @return OffreCompetence[] Returns an array of OffreCompetence objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreCompetence
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
