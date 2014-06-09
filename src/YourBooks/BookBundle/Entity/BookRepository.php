<?php

namespace YourBooks\BookBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends EntityRepository
{
    public function countBooksSubmit($author)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('count(b.id)')
            ->where('b.author = :author')
            ->setParameter(':author', $author)
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countBooksRead($author)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('count(b.id)')
            ->where('b.author = :author')
            ->andWhere('b.readerValidation = :readerValidation')
            ->setParameter(':author', $author)
            ->setParameter(':readerValidation', true)
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findBySearch($search)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->andwhere("b.title LIKE :search")
            ->orderBy('b.title', 'ASC')
            ->setParameter(':search', '%'.$search.'%')
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findBySearchCat($search, $cat)
    {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.category',  'c')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->andwhere("b.title LIKE :search")
            ->andWhere("c.id = :cat")
            ->orderBy('b.title', 'ASC')
            ->setParameter(':search', '%'.$search.'%')
            ->setParameter(':cat', $cat)
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function autoCompletion($search)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b.title')
            ->where('b.readerValidation = :readerValidation')
            ->andwhere("b.title LIKE :search")
            ->orderBy('b.title', 'ASC')
            ->setParameter(':search', '%'.$search.'%')
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function autoCompletionCat($search, $cat)
    {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.category',  'c')
            ->select('b.title')
            ->where('b.readerValidation = :readerValidation')
            ->andwhere("b.title LIKE :search")
            ->andWhere("c.id = :cat")
            ->orderBy('b.title', 'ASC')
            ->setParameter(':search', '%'.$search.'%')
            ->setParameter(':cat', $cat)
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findOnlyReading()
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->orderBy('b.createdAt', 'DESC')
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findByOrderAlphabetic($order)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->orderBy('b.title', $order)
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findByOrderNote($order)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.review',  'r')
            ->where('b.readerValidation = :readerValidation')
            ->orderBy('r.noteGlobale', $order)
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findByOrderDate($order)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->orderBy('b.createdAt', $order)
            ->setParameter(':readerValidation', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findByCategory($categoryId)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.readerValidation = :readerValidation')
            ->andWhere('b.category = :category')
            ->orderBy('b.createdAt', 'DESC')
            ->setParameter(':readerValidation', true)
            ->setParameter(':category', $categoryId)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findDelayOutReader()
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.receivedByReader = :receivedByReader')
            ->andWhere('DATE_DIFF(CURRENT_DATE(), b.receivedByReaderAt) > 10')
            ->setParameter(':receivedByReader', true)
        ;

        return $qb->getQuery()->getResult();
    }
    public function findSoonDelayOutReader()
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.receivedByReader = :receivedByReader')
            ->andWhere('DATE_DIFF(CURRENT_DATE(), b.receivedByReaderAt) = 9')
            ->setParameter(':receivedByReader', true)
        ;

        return $qb->getQuery()->getResult();
    }
    public function findDelayConfirmedReader()
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->Where('DATE_DIFF(CURRENT_DATE(), b.sendToReaderAt) > 2')
            ->andWhere('b.receivedByReader = :receivedByReader')
            ->setParameter(':receivedByReader', false)
        ;

        return $qb->getQuery()->getResult();
    }

}
