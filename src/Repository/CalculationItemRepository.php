<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CalculationItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CalculationItem>
 *
 * @method CalculationItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalculationItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalculationItem[]    findAll()
 * @method CalculationItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalculationItemRepository extends ServiceEntityRepository implements CalculationItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalculationItem::class);
    }

    public function getCalculationItemsCount(): int
    {
        try {
            return (int)$this->createQueryBuilder('e')
                ->select('COUNT(e.id)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException|NoResultException) {
            return 0;
        }
    }

    public function getCalculationItemsList(int $offset, int $limit): array
    {
        return $this->createQueryBuilder('e')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function save(CalculationItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CalculationItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
