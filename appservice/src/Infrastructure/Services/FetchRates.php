<?php
namespace Evento\Infrastructure\Services;

use Evento\Domain\Exchange\ExchangeRepositoryInterface;
use Exception;

class FetchRates implements FetchRatesInterface
{
    private ProviderInterface $provider;

    public function __construct(
        ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function fetch(array $input = []): array
    {
        $exchange = $this->provider->getContent($input);

        $ratesArr = [];
        foreach ($exchange as $rates)
        {
            foreach ($rates['rates'] as $currency)
            {
                $ratesArr[] = [
                'currency' => $currency['currency'],
                'code' => $currency['code'],
                'bid' => $currency['bid'],
                'ask' => $currency['ask']
                ];
           }
       }

        return $ratesArr;
    }
}
