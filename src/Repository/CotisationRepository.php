<?php

namespace App\Repository;

use App\Entity\Cotisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cotisation>
 *
 * @method Cotisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cotisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cotisation[]    findAll()
 * @method Cotisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CotisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cotisation::class);
    }

    public function save(Cotisation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cotisation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findLast5(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.created_at', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult()

            ;
    }

    /**
     * @return Cotisation[] Returns an array of Cotisation objects
     */
    public function findByYear(): array
    {
        $year = date("Y");
        return $this->createQueryBuilder('a')
            ->Where('DATE_FORMAT(a.created_at, :format) = :val')
            ->setParameter("val", $year)
            ->setParameter("format", '%Y')
            ->getQuery()
            ->getResult()

            ;
    }

    public function findByMonth(): array
    {
        $month = date("Y-m");
        return $this->createQueryBuilder('a')
            ->Where('DATE_FORMAT(a.created_at, :format) = :val')
            ->setParameter("val", $month)
            ->setParameter("format", '%Y-%m')
            ->getQuery()
            ->getResult()

            ;
    }

    public function findByDay(): array
    {
        $day = date("Y-m-d");
        return $this->createQueryBuilder('a')
            ->Where('DATE_FORMAT(a.created_at, :format) = :val')
            ->setParameter("val", $day)
            ->setParameter("format", '%Y-%m-%d')
            ->getQuery()
            ->getResult()

            ;
    }

//    /**
//     * @return Cotisation[] Returns an array of Cotisation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cotisation
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
