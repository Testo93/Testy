<?php

namespace BlogBundle\Repository;

use BlogBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function findByCategory(Category $category)
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->where('p.category = :category')
                ->setParameter('category', $category)
                ->getQuery()
                ->getResult()
            ;
            if($articles)
            {
                return $articles;
            }else {
                return null;
            }
        } catch (\Exception $ex) {
            return null;
        }
    }

    public function findByIds( Category $category)
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->where('p.category = :category')
                ->setParameter('category', $category)
                ->getQuery()
                ->getArrayResult()
            ;
            return $articles;
        } catch (\Exception $ex) {
            return null;
        }
    }


    public function getLast($number)
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->orderBy('p.date')
                ->setMaxResults($number)
                ->getQuery()
                ->getArrayResult()
            ;

            return $articles;
        } catch (\Exception $ex) {
            return null;
        }
    }


    public function searchByName($search)
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->where('p.name LIKE :name')
                ->setParameter('name', '%'.$search.'%')
                ->getQuery()
                ->getResult();
            // ->getOneOrNullResult() équivalent au getSingleResult()

            return $articles;
        } catch (\Exception $ex) {
//            print_r($ex);
//            return null;
            throw new \Exception($ex);
        }
    }

    public function countAll()
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->select('count(p)')
                ->getQuery()
                ->getResult();

            return $articles;
        } catch (\Exception $ex) {
//            print_r($ex);
//            return null;
            throw new \Exception($ex);
        }
    }

    public function countAllByCat(Category $category)
    {
        try {
            $articles = $this
                ->createQueryBuilder('p')
                ->select('count(p)')
                ->where('p.category = :category')
                ->setParameter('category', $category)
                ->getQuery()
                ->getResult();

            return $articles;
        } catch (\Exception $ex) {
//            print_r($ex);
//            return null;
            throw new \Exception($ex);
        }
    }

}
