<?php declare(strict_types=1);
namespace Evento\Tests\Unit\Infrastructure\Repository;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\Exchange\Rate;
use Evento\Tests\Domain\CountCurrency\AmountDiffCalculator;
use PHPUnit\Framework\TestCase;

class RateAmountCalculatorTest extends TestCase
{
    public function test_rate(): void
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

        $rateRepository = $this->createMock(EntityRepository::class);
        $rateRepository->expects($this->any())
            ->method('find')
            ->willReturn($rate);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($rateRepository);

        $amountDifferent = new AmountDiffCalculator($entityManager);
        $actualValue = $amountDifferent->calculateDiffAmount(1);

        $this->assertIsFloat($actualValue, "value is float or not");

    }
}
