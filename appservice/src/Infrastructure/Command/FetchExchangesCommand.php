<?php
namespace Evento\Infrastructure\Command;

use Evento\Application\Handler\Exchange\CreateExchangeHandler;
use Evento\Infrastructure\Services\FetchExchangesInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:fetch-exchanges')]
class FetchExchangesCommand extends Command
{
    private CreateExchangeHandler $createExchangeHandler;
    private FetchExchangesInterface $fetcherService;

    public function __construct(
        CreateExchangeHandler $createExchangeHandler,
        FetchExchangesInterface $fetcherService
    )
    {
        $this->createExchangeHandler = $createExchangeHandler;
        $this->fetcherService = $fetcherService;
        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();
        $this->addArgument('count', InputArgument::OPTIONAL, 'Your count?')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $exchanges = $this->fetcherService->fetch(
            [
                'count' => $input->getArgument('count')
            ]);

        foreach($exchanges as $exchange) {

            try {
                $this->createExchangeHandler->handle($exchange);
                $output->writeln('Exchange Table: ['.$exchange['no'].'] saved');
            } catch (Exception $e) {
                $output->writeln($e->getMessage());
            }
        }

        $output->writeln('Exchange Tables done');

        return Command::SUCCESS;
    }
}
