<?php

namespace App\Repository;

use App\Entity\BaremeGarcon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BaremeGarcon>
 *
 * @method BaremeGarcon|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaremeGarcon|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaremeGarcon[]    findAll()
 * @method BaremeGarcon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaremeGarconRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaremeGarcon::class);
    }

    public function save(BaremeGarcon $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BaremeGarcon $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BaremeGarcon[] Returns an array of BaremeGarcon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BaremeGarcon
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
