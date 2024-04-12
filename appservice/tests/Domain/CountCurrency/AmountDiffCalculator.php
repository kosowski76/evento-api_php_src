<?php
namespace Evento\Tests\Domain\CountCurrency;

use Doctrine\ORM\EntityManager;
use Evento\Domain\Exchange\Rate;

class AmountDiffCalculator
{
    public function __construct(
        private EntityManager $entityManager,
    ) {
    }

    public function calculateDiffAmount(int $id): float
    {
        $rateRepository = $this->entityManager
            ->getRepository(Rate::class);
        $rate = $rateRepository->find($id);

        return ($rate->getAsk() - $rate->getBid());
    }
}
