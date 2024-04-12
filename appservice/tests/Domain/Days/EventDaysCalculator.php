<?php
namespace Evento\Tests\Domain\Days;

use Doctrine\ORM\EntityManager;
use Evento\Domain\Event\Event;

class EventDaysCalculator
{
    public function __construct(
        private EntityManager $entityManager,
    ) {
    }

    public function calculateTotalDays(int $id): int
    {
        $eventRepository = $this->entityManager
            ->getRepository(Event::class);
        $event = $eventRepository->find($id);

        $origin = $event->getStartDate();
        $target = $event->getEndDate();

        return $origin->diff($target)->format("%a");
    }
}
