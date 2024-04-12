<?php

namespace Evento\Domain\Event;

// use Evento\Domain\Event\Event;
use DateTime;
use Evento\Domain\User\User;

class Ticket
{
    private int $id;
    private Event $event;
    private int $seating;
    private float $price;
    private User $user;
    private string $username;
    private DateTime $purchasedAt;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getEvent(): Event
    {
        return $this->event;
    }
    public function setEvent(Event $event): self
    {
        $this->event = $event;

        return $this;
    }
    public function getSeating(): int
    {
        return $this->seating;
    }
    public function setSeating(int $seating): self
    {
        $this->seating = $seating;

        return $this;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
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
    public function getPurchasedAt(): DateTime
    {
        return $this->purchasedAt;
    }
    public function setPurchasedAt(DateTime $purchasedAt): self
    {
        $this->purchasedAt = $purchasedAt;

        return $this;
    }
}
