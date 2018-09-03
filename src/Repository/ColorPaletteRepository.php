<?php

namespace App\Repository;

use App\Entity\ColorPalette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColorPalette|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorPalette|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorPalette[]    findAll()
 * @method ColorPalette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorPaletteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColorPalette::class);
    }

    /**
    * @return ColorPalette[] Returns an array of ColorPalette objects
    */
    public function findPopular()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.views', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }
}
