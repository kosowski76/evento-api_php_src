<?php
namespace Evento\Tests\Domain\Days;

use Doctrine\ORM\EntityManager;
use Evento\Domain\Exchange\Exchange;

class ExchangeDaysCalculator
{
    public function __construct(
        private EntityManager $entityManager,
    ) {
    }

    public function calculateDiffDays(int $id): int
    {
        $exchangeRepository = $this->entityManager
            ->getRepository(Exchange::class);
        $exchange = $exchangeRepository->find($id);

        $origin = $exchange->getTradingDate();
        $target = $exchange->getEffectiveDate();

        return $origin->diff($target)->format("%a");
    }
}
