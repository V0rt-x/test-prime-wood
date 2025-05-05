<?php

namespace TestPrimeWood\Domain\Entities;

use DateTime;

class Product
{
    public function __construct(
        protected string $name,
        protected float $price,
        protected DateTime $datetime,
        protected ?int $id = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'datetime' => $this->datetime,
        ];
    }
}