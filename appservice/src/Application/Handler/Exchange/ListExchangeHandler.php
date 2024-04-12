<?php
namespace Evento\Application\Handler\Exchange;

use Evento\Domain\Exchange\ExchangeRepositoryInterface;

class ListExchangeHandler
{
    private ExchangeRepositoryInterface $exchangeRepository;

    public function __construct(ExchangeRepositoryInterface $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        return $this->exchangeRepository->findAll();
    }
}