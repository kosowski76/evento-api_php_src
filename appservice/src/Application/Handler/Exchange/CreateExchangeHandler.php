<?php
namespace Evento\Application\Handler\Exchange;

use DateTime;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\ExchangeRepositoryInterface;
use Exception;

class CreateExchangeHandler
{
    private ExchangeRepositoryInterface $exchangeRepository;

    public function __construct(
        ExchangeRepositoryInterface $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }

    /**
     * @param array $exchange
     * @throws Exception|\Doctrine\ORM\Exception\ORMException
     */
    public function handle(array $exchange): void
    {
        if ($this->exchangeRepository->findOneBy(['no' => $exchange['no']])) {
            throw new Exception('Exchange Table: ['.$exchange['no'].'] already saved');
        }

        $this->exchangeRepository->save(
            (new Exchange())
                ->setTableC($exchange['table'])
                ->setNo($exchange['no'])
                ->setTradingDate($exchange['tradingDate'])
                ->setEffectiveDate($exchange['effectiveDate'])
        );
    }
}