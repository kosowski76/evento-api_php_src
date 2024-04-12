<?php
namespace Evento\Domain\Event;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Evento\Domain\Event\Ticket;

class Event
{
    private int $id;
    private ?string $name = "";
    private string $description;
    private DateTime $createdAt;
    private DateTime $startDate;
    private DateTime $endDate;
    private DateTime $updatedAt;
    private Collection $tickets;

    public function __construct()
    {
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
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;

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
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }
    public function setStartDate(DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }
    public function setEndDate(DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function getTickets(): Collection
    {
        return $this->tickets;
    }
    public function setTickets(Collection $tickets): self
    {
        $this->tickets = $tickets;

        return $this;
    }
    public function addTicket(Ticket $ticket) {
        $this->tickets->add($ticket);
    }
}
