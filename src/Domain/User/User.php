<?php

namespace IESLaCierva\Domain\User;

use IESLaCierva\Domain\User\Exceptions\EmailNotValidException;
use IESLaCierva\Domain\User\ValueObject\Email;
use IESLaCierva\Domain\User\ValueObject\Role;

class User implements \JsonSerializable
{
    private string $id;
    private string $name;
    private string $image;
    private bool $isActive;
    private string $endDate;
    private int $currentPrice;
    private int $directBidPrice1;
    private int $directBidPrice2;
    private int $directBidPrice3;

    public function __construct(string $id, string $name, string $image, bool $isActive, string $endDate,
                                int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->isActive = $isActive;
        $this->endDate = $endDate;
        $this->currentPrice = $currentPrice;
        $this->directBidPrice1 = $directBidPrice1;
        $this->directBidPrice2 = $directBidPrice2;
        $this->directBidPrice3 = $directBidPrice3;
    }

    public static function create(string $id, string $name, string $image, bool $isActive, string $endDate,
                                  int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3): User
    {
        return new self(uniqid(), $id, $name, $image, $isActive, $endDate, $currentPrice, $directBidPrice1, $directBidPrice2, $directBidPrice3);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function endDate(): string
    {
        return $this->endDate;
    }

    public function currentPrice(): int
    {
        return $this->currentPrice;
    }

    public function directBidPrice1(): int
    {
        return $this->directBidPrice1;
    }

    public function directBidPrice2(): int
    {
        return $this->directBidPrice2;
    }

    public function directBidPrice3(): int
    {
        return $this->directBidPrice3;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'image' => $this->image(),
            'isActive' => $this->isActive(),
            'endDate' => $this->endDate(),
            'currentPrice' => $this->currentPrice(),
            'directBidPrice1' => $this->directBidPrice1(),
            'directBidPrice2' => $this->directBidPrice2(),
            'directBidPrice3' => $this->directBidPrice3()
        ];
    }


}
