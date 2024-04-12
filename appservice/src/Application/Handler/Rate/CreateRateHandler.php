<?php
namespace Evento\Application\Handler\Rate;

use Evento\Domain\Exchange\ExchangeRepositoryInterface;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\Rate;
use Evento\Domain\Rate\RateRepositoryInterface;
use Exception;

class CreateRateHandler
{
    private RateRepositoryInterface $rateRepository;
    private ExchangeRepositoryInterface $exchangeRepository;

    public function __construct(
        RateRepositoryInterface $rateRepository,
        ExchangeRepositoryInterface $exchangeRepository
    )
    {
        $this->exchangeRepository =$exchangeRepository;
        $this->rateRepository = $rateRepository;
    }

    /**
     * @param array $rate
     * @throws Exception
     */
    public function handle(array $rate): void
    {
        $exchange = $this->exchangeRepository->findOneBy(['id' => $rate['exchangeId']]);
        if (!$exchange) {
            throw new Exception($rate['exchangeId']." Exchange is not the part of our database");
        }

        $rateExist = $this->rateRepository->findBy([
            'exchange' => $exchange->getId(),
            'code' => $rate['code']]);
        if($rateExist) {
            throw new Exception('Currency: ['.$rate['code'].'] in table ['.$exchange->getNo().'] already saved');
        }

        $this->rateRepository->save(
            (new Rate())
                ->setCurrency($rate['currency'])
                ->setCode($rate['code'])
                ->setBid($rate['bid'])
                ->setAsk($rate['ask'])
                ->setExchange($exchange)
        );
    }
}