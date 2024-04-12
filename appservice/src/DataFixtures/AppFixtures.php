<?php
namespace Evento\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Evento\Domain\Event\Event;
use Evento\Domain\Exchange\Exchange;
use Evento\Domain\User\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher; }

    public function load(ObjectManager $manager): void
    {
        $event = (new Event())->setId(1);
        $event->setName('Local Events');
        $event->setDescription('Some in Local Events');
        $event->setCreatedAt(new DateTime('now'));
        $event->setStartDate(new DateTime("2024-07-04 18:00:00"));
        $event->setEndDate(new DateTime("2024-07-05 21:30:00"));
        $event->setUpdatedAt(new DateTime('now'));

        $manager->persist($event);

        $user = new User();
        $user->setEmail('user@test.com');
        $user->setUsername('tester');
        $password = $this->hasher->hashPassword($user, '123123');
        $user->setPassword($password);

        $manager->persist($user);
/*
        $exchange = (new Exchange())->setId(1);
        $exchange->setTableC('C');
        $exchange->setNo('070/C/NBP/2024');
        $exchange->setTradingDate('2024-04-08');
        // $exchange->setTradingDate(new DateTime("2024-04-08"));
        $exchange->setEffectiveDate('2024-04-09');
        // $exchange->setEffectiveDate(new DateTime("2024-04-08"));

        $manager->persist($exchange);
*/
        $manager->flush();
    }
}
