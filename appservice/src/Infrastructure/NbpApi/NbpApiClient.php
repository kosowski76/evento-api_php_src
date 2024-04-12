<?php

namespace Evento\Infrastructure\NbpApi;

use Evento\Infrastructure\Services\ProviderInterface;
use Exception;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NbpApiClient implements ProviderInterface
{
    const API_NBP_URI_EXCHANGE_RATE_TABLE_C = 'https://api.nbp.pl/api/exchangerates/tables/c/';
    const API_NBP_URI_EXCHANGE_RATE_TABLE_C_TOP = 'https://api.nbp.pl/api/exchangerates/tables/c/last/';
    //const API_NBP_URI_EXCHANGE_RATE_TABLE_C_DATA = 'https://api.nbp.pl/api/exchangerates/tables/c/';
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $criteria
     * @return array|bool|float|int|object|string|null
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     */
    public function getContent(array $criteria): float|object|int|bool|array|string|null
    {
        $response = "";

        if (!$criteria)
        {
            $response = $this->client->request(
                'GET',
                self::API_NBP_URI_EXCHANGE_RATE_TABLE_C
            );
        }

        if(!isset($criteria['count'])) { $criteria['count'] = "1";}
        if(isset($criteria['count']))
        {
            $response = $this->client->request(
                'GET',
                self::API_NBP_URI_EXCHANGE_RATE_TABLE_C_TOP.$criteria['count']
            );
        }

        if (isset($criteria['data']))
        {
            $data = (string)$criteria['data']->format("Y-m-d");
            $response = $this->client->request(
                'GET',
                self::API_NBP_URI_EXCHANGE_RATE_TABLE_C.$data
            );
        }

        return $response->toArray();
    }
}
