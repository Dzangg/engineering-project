<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    public function findAllWithGestures(): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.gestures', 'g') // Join gestures
            ->addSelect('g')             // Fetch gestures data
            ->getQuery()
            ->getResult();
    }

}