<?php

namespace App\Repository;

use App\Entity\DroitAdhesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DroitAdhesion>
 *
 * @method DroitAdhesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method DroitAdhesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method DroitAdhesion[]    findAll()
 * @method DroitAdhesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DroitAdhesionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DroitAdhesion::class);
    }

    public function save(DroitAdhesion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DroitAdhesion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DroitAdhesion[] Returns an array of DroitAdhesion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DroitAdhesion
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
