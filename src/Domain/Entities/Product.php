<?php
declare(strict_types=1);

namespace TestPrimeWood\Domain\Entities;

use DateTime;

class Product
{
    const string DEFAULT_DATETIME_FORMAT = 'd.m.Y H:i:s';
    const string DATABASE_DATETIME_FORMAT = 'Y-m-d H:i:s';

    public function __construct(
        protected string   $name,
        protected int      $price,
        protected DateTime $datetime,
        protected ?int     $id = null,
    )
    {
    }

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
            'datetime' => $this->datetime->format(self::DATABASE_DATETIME_FORMAT),
        ];
    }

    public static function fromArray(array $product): static
    {
        return new static($product['name'], intval($product['price']), DateTime::createFromFormat(self::DATABASE_DATETIME_FORMAT, $product['datetime']), intval($product['id']));
    }
}