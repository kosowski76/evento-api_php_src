<?php

namespace Evento\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\ExchangeRepositoryInterface;

class ExchangeRepository extends ServiceEntityRepository implements ExchangeRepositoryInterface
{
    private EntityManagerInterface $_em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->_em = $entityManager;
        parent::__construct($registry, Exchange::class);
    }

    /**
     * @param Exchange $exchange
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Exchange $exchange)
    {
        $this->_em->persist($exchange);
        $this->_em->flush();
    }
}