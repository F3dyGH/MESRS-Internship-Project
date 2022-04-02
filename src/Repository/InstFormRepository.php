<?php

namespace App\Repository;

use App\Entity\InstForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InstForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstForm[]    findAll()
 * @method InstForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstForm::class);
    }

     /**
      * @return InstForm[] Returns an array of InstForm objects
      */

    public function findByUserRole($inst)
    {

        /*return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $role)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;*/
        return $this->createQueryBuilder('i')
            ->join('i.inst', 'u')
            ->addSelect('u')
            ->where('u.id = :inst')
            ->andWhere('u.roles IN (:role)')
            ->setParameter('id', $inst)
            ->setParameter('roles', array('ROLE_STUD'))
            ->getQuery()->getResult()
            ;
    }

    public function findByInstId($instId)
    {
        $qb = $this->createQueryBuilder('ii');
        $qb->where('IDENTITY(ii.inst) = :instId')
            ->setParameter('instId', $instId);

        return $qb->getQuery()->getResult();
    }
    /*
    public function findOneBySomeField($value): ?InstForm
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
