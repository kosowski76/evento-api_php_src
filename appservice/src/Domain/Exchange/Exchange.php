<?php
namespace Evento\Domain\Exchange;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Exchange
{
    private int $id;
    private ?string $tableC = "";
    private ?string $no = "";
    private ?DateTime $tradingDate = null;
    private ?DateTime $effectiveDate = null;
    private Collection $rates;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
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

    public function getTableC(): string
    {
        return $this->tableC;
    }

    public function setTableC(string $table): self
    {
        $this->tableC = $table;

        return $this;
    }

    public function getNo(): string
    {
        return $this->no;
    }

    public function setNo(string $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getTradingDate(): DateTime
    {
        return $this->tradingDate;
    }

    public function setTradingDate(DateTime $tradingDate): self
    {
        $this->tradingDate = $tradingDate;

        return $this;
    }

    public function getEffectiveDate(): DateTime
    {
        return $this->effectiveDate;
    }

    public function setEffectiveDate(DateTime $effectiveDate): self
    {
        $this->effectiveDate = $effectiveDate;

        return $this;
    }

    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function setRates(Collection $rates): self
    {
        $this->rates = $rates;

        return $this;
    }

    public function addRate(Rate $rate): void
    {
        $this->rates->add($rate);
    }
}