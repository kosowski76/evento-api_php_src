<?php declare(strict_types=1);
namespace Evento\Tests\Feature\Infrastructure;

use Doctrine\ORM\EntityManager;
use Evento\Domain\Event\Event;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EventRepositoryTest extends KernelTestCase
{
    public function testSometing(): void
    {
        $this->assertTrue(true);
    }
    
}
