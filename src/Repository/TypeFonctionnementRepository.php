<?php

namespace App\Repository;

use App\Entity\TypeFonctionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeFonctionnement>
 *
 * @method TypeFonctionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFonctionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFonctionnement[]    findAll()
 * @method TypeFonctionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFonctionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFonctionnement::class);
    }

    public function save(TypeFonctionnement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeFonctionnement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeFonctionnement[] Returns an array of TypeFonctionnement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeFonctionnement
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
