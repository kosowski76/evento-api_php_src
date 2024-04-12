<?php

namespace Evento\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Evento\Domain\Exchange\Rate;
use Evento\Domain\Rate\RateRepositoryInterface;

class RateRepository extends ServiceEntityRepository implements RateRepositoryInterface
{
    private EntityManagerInterface $_em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->_em = $entityManager;
        parent::__construct($registry, Rate::class);
    }

    /**
     * @param Rate $match
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Rate $match)
    {
        $this->_em->persist($match);
        $this->_em->flush();
    }

}