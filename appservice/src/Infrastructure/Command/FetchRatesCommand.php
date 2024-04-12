<?php
namespace Evento\Infrastructure\Command;

use ArrayObject;
use Evento\Application\Handler\Exchange\ListExchangeHandler;
use Evento\Application\Handler\Rate\CreateRateHandler;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\ExchangeRepositoryInterface;
use Evento\Infrastructure\Services\FetchRatesInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:fetch-rates')]
class FetchRatesCommand extends Command
{
    private FetchRatesInterface $fetchRates;
    private CreateRateHandler $createRateHandler;
    private ListExchangeHandler $listExchangeHandler;

    public function __construct(
        FetchRatesInterface $fetchRates,
        CreateRateHandler $createGameHandler,
        ListExchangeHandler $listExchangeHandler,
    )
    {
        $this->createRateHandler = $createGameHandler;
        $this->fetchRates = $fetchRates;
        $this->listExchangeHandler = $listExchangeHandler;

        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $exchanges = $this->listExchangeHandler->handle();

        foreach ($exchanges as $exchange)
        {
            $output->writeln('Exchange Table: '. $exchange->getNo());
            $rates = $this->fetchRates->fetch(
                [
                    'data' => $exchange->getEffectiveDate()
                ]);

            // print_r($rates); echo PHP_EOL;
            foreach ($rates as $rate)
            {
                $rate['exchangeId'] = $exchange->getId();
                // print_r($rate); echo PHP_EOL;
                try {
                    $this->createRateHandler->handle($rate);
                    $output->writeln('Currency: ['.$rate['code'].'] are saved in table ['.$exchange->getNo().'].');
                } catch (Exception $e) {
                    $output->writeln($e->getMessage());
                }
            }
        }

        $output->writeln('Rates are done');

        return Command::SUCCESS;
    }
}