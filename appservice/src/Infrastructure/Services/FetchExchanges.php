<?php
namespace Evento\Infrastructure\Services;

use DateTime;

class FetchExchanges implements FetchExchangesInterface
{
    private ProviderInterface $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function fetch(array $input): array
    {
        $exchanges = $this->provider->getContent($input);

        $exchangesResult = [];
        foreach ($exchanges as $exchange) {

            $exchangesResult[] = [
                'table' => $exchange['table'],
                'no' => $exchange['no'],
                'tradingDate' => new DateTime($exchange['tradingDate']),
                'effectiveDate' =>  new DateTime($exchange['effectiveDate'])
            ];
        }

        return $exchangesResult;
    }
}
