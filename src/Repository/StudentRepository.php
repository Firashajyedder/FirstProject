<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
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
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneBySomeField()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.NSC LIKE  :nsc')
            ->setParameter('nsc', 'a%')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findOneByClasse($value)
    {
        return $this->createQueryBuilder('s')
            ->join('s.classroom','c')
            ->addSelect('c')
            ->Where('c.id =:id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findStudentByEmail()
    {



        $entityManger=$this->getEntityManager();
        $query=$entityManger->createQuery('SELECT p FROM App\Entity\Student p ORDER BY p.email ASC');

        return $query->getResult();
        
    }
    public function findOneByNSC($n)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.NSC = :nsc')
            ->setParameter('nsc', $n)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function orderByDate()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.creation_date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }

    public function EnabledStudent(){

        $qb= $this->createQueryBuilder('s');
        $qb ->where('s.enabled=:enabled');
        $qb->setParameter('enabled',true);
        return $qb->getQuery()->getResult();

      

    }


     public function studentsDate($date1,$date2){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\Student s WHERE s.date_naissance BETWEEN :date1 AND :date2")
            ->setParameters(['date1'=>$date1,'date2'=>$date2]);
        return $query->getResult();

 
    }


    public function findStudentByMOY($min,$max){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\Student s WHERE s.moyenne BETWEEN :min AND :max")
            ->setParameter('min',$min)
            ->setParameter('max',$max)
            ;
        return $query->getResult();
    }

    

    public function findlStudentredoublant(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT s FROM APP\Entity\Student s WHERE s.moyenne <= 8")
          ;
        return $query->getResult();
    }



}
