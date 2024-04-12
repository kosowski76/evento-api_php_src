<?php
namespace Evento\Domain\User;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Evento\Domain\Event\Event;
use Evento\Domain\Event\Ticket;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function Sodium\add;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private $roles = [];
    private bool $isActive;
    private int $avatar;
    private DateTime $createdAt;
    private Collection $tickets;

    function __construct()
    {
        $this->avatar = 1;
        $this->createdAt = new DateTime();
        $this->isActive = true;
        $this->tickets = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getUserIdentifier(): string
    {
        // return (string) $this->username;
        return (string) $this->email;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function getAvatar(): int
    {
        return $this->avatar;
    }
    public function setAvatar(int $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
    public function getTickets(): Collection
    {
        return $this->tickets;
    }
    public function setTickets(ArrayCollection $tickets): self
    {
        $this->tickets = $tickets;

        return $this;
    }
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function getSalt()
    {
        return null;
    }
    public function eraseCredentials(): void
    {}
    /**
     * @param Game $game
     * @param int $homeTeamGuess
     * @param int $awayTeamGuess
     * @throws Exception
     */
    public function makeTickets(Event $event)
    {
        if ((new DateTime()) > $event->getStartDate()) {
            throw new Exception("Starting time passed for this event, cant make a ticket");
        }

        $ticket = new Ticket();
        $ticket->setUser($this);
        $ticket->setEvent($event);
        $ticket->setCreatedAt(new DateTime());

        $this->tickets->add($ticket);
        $event->addTicket($ticket);
    }
}
