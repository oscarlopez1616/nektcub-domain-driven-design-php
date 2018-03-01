<?php

namespace App\Infrastructure\Doctrine\Hexahedron\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Domain\Hexahedron\Model\Cube;
use App\Domain\Hexahedron\Repository\CubeRepositoryInterface;

/**
 * @method Example|null find($id, $lockMode = null, $lockVersion = null)
 * @method Example|null findOneBy(array $criteria, array $orderBy = null)
 * @method Example[]    findAll()
 * @method Example[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CubeRepository extends ServiceEntityRepository implements CubeRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cube::class);
    }

    public function save(Cube $cube)
    {
        $this->getEntityManager()->persist($cube);
        $this->getEntityManager()->flush();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('e')
            ->where('e.something = :value')->setParameter('value', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
