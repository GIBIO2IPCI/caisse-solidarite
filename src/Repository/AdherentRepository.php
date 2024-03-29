<?php

namespace App\Repository;

use App\Entity\Adherent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adherent>
 *
 * @method Adherent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adherent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adherent[]    findAll()
 * @method Adherent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdherentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adherent::class);
    }

    public function save(Adherent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Adherent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

/**
 * @return Adherent[] Returns an array of Adherent objects
 */
public function findByStatus(int $status): array {
    return $this->createQueryBuilder('a')
            ->Where('a.statut =  :val')
            ->setParameter("val", $status)
            ->getQuery()
            ->getResult()

        ;
    }

    /**
     * @return Adherent[] Returns an array of Adherent objects
     */
    public function findBySexe(int $sexe): array {
        return $this->createQueryBuilder('a')
            ->Where('a.sexe = :val')
            ->setParameter("val", $sexe)
            ->getQuery()
            ->getResult()

            ;
    }

    /**
    * @return Adherent[] Returns an array of Adherent objects
    */
    public function findByYear(): array
    {
        $year = date("Y");
        return $this->createQueryBuilder('a')
        ->Where('DATE_FORMAT(a.date_inscription, :format) = :val')
        ->setParameter("val", $year)
        ->setParameter("format", '%Y')
        ->getQuery()
        ->getResult()

        ;
    }

    /**
     * @return Adherent[] Returns an array of Adherent objects
     */
    public function findByMonth(): array
    {
        $year = date("Y-m");
        return $this->createQueryBuilder('a')
            ->Where('DATE_FORMAT(a.date_inscription, :format) = :val')
            ->setParameter("val", $year)
            ->setParameter("format", '%Y-%m')
            ->getQuery()
            ->getResult()

            ;
    }

    /**
     * @return Adherent[] Returns an array of Adherent objects
     */
    public function findByDay(): array
    {
        $year = date("Y-m-d");
        return $this->createQueryBuilder('a')
            ->Where('DATE_FORMAT(a.date_inscription, :format) = :val')
            ->setParameter("val", $year)
            ->setParameter("format", '%Y-%m-%d')
            ->getQuery()
            ->getResult()

            ;
    }



//    /**
//     * @return Adherent[] Returns an array of Adherent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Adherent
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
