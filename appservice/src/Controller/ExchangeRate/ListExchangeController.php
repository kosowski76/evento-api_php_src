<?php

namespace Evento\Controller\ExchangeRate;

use Evento\Application\Handler\Exchange\ListExchangeHandler;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\ExchangeRepositoryInterface;
use Evento\Domain\Exchange\Rate;
use Evento\Domain\Rate\RateRepositoryInterface;
use Exception;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use function PHPUnit\Framework\isEmpty;

class ListExchangeController extends AbstractController
{

    private ListExchangeHandler $listExchangeHandler;
    private ExchangeRepositoryInterface $exchangeRepository;
    private RateRepositoryInterface $rateRepository;

    public function __construct(
        ListExchangeHandler $listExchangeHandler,
        ExchangeRepositoryInterface $exchangeRepository,
        RateRepositoryInterface $rateRepository
    )
    {
        $this->listExchangeHandler = $listExchangeHandler;
        $this->exchangeRepository = $exchangeRepository;
        $this->rateRepository = $rateRepository;
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        $exchanges = $this->listExchangeHandler->handle();

        $allExchanges = [];

        foreach ($exchanges as $exchange) {

            $allExchanges[] = [
                'id' => $exchange->getId(),
                'table_c' => $exchange->getTableC(),
                'no' => $exchange->getNo(),
                'trading_date' => $exchange->getTradingDate()->format('Y-m-d'),
                'effective_date' => $exchange->getEffectiveDate()->format('Y-m-d'),
                'rates' => $this->hasExchangeRates($exchange ?? null)

            ];
        }

        return new JsonResponse($allExchanges);
    }

    public function hasExchangeRates(Exchange $exchange): array {

        $allRates = [];
        $rates = [];

        $rates = $this->rateRepository->findBy([
            'exchange' => $exchange->getId(),
        ]);

        /** @var Rate $rate */
        foreach ($rates as $rate)
        {
            $allRates[] = [
                'id' => $rate->getId(),
                'currency' => $rate->getCurrency(),
                'code' => $rate->getCode(),
                'bid' => $rate->getBid(),
                'ask' => $rate->getAsk(),
            ];
        }

        return $allRates;
    }
}