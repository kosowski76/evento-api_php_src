<?php declare(strict_types=1);
namespace Evento\Tests\Unit\Infrastructure\Repository;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Evento\Domain\Event\Event;
use Evento\Domain\Event\Ticket;
use Evento\Tests\Domain\Days\EventDaysCalculator;
use PHPUnit\Framework\TestCase;

class EventDaysCalculatorTest extends TestCase
{
    public function test_event(): void
    {
        $event = new Event();
        $event->setId(1);
        $event->setName("Some Event-1");
        $event->setDescription("Description Event-1");
        $event->setCreatedAt(new DateTime("2024-01-01 00:00:00"));
        $event->setStartDate(new DateTime("2024-07-02 18:00:00"));
        $event->setEndDate(new DateTime("2024-07-05 21:30:00"));
        $event->setUpdatedAt(new DateTime("2024-02-02 00:00:00"));

        $ticket = new Ticket();
        $ticket->setEvent($event);
        $ticket->setSeating(10);

        $event->addTicket($ticket);

        $eventRepository = $this->createMock(EntityRepository::class);
        $eventRepository->expects($this->any())
            ->method('find')
            ->willReturn($event);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($eventRepository);

        $numberDaysEvent1 = new EventDaysCalculator($entityManager);
        $this->assertEquals(3, $numberDaysEvent1->calculateTotalDays(1));
    }
}
