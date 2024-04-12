<?php declare(strict_types=1);
namespace Evento\Tests\Unit\Infrastructure\Repository;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\Rate;
use Evento\Tests\Domain\Days\ExchangeDaysCalculator;
use PHPUnit\Framework\TestCase;

class ExchangeDaysCalculatorTest extends TestCase
{
    public function test_exchange(): void
    {
        $exchange = new Exchange();
        $exchange->setId(1);
        $exchange->setTableC("C");
        $exchange->setNo("069/C/NBP/2024");
        $exchange->setTradingDate(new DateTime("2024-04-05"));
        $exchange->setEffectiveDate(new DateTime("2024-04-08"));

        $rate = new Rate();
        $rate->setExchange($exchange);
        $rate->setCurrency("dolar amerykański");
        $rate->setCode("USD");
        $rate->setBid(3.9263);
        $rate->setAsk(4.0057);

        $exchange->addRate($rate);

        $exchangeRepository = $this->createMock(EntityRepository::class);
        $exchangeRepository->expects($this->any())
            ->method('find')
            ->willReturn($exchange);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($exchangeRepository);

        $numberDaysTable69 = new ExchangeDaysCalculator($entityManager);
        $this->assertEquals(3, $numberDaysTable69->calculateDiffDays(1));
    }
}
