<?php

namespace IESLaCierva\Domain\Article;

class Article implements \JsonSerializable
{
    private string $id;
    private string $name;
    private string $description;
    private string $image;
    private bool $isActive;
    private string $endDate;
    private int $currentPrice;
    private int $directBidPrice1;
    private int $directBidPrice2;
    private int $directBidPrice3;

    public function __construct(string $id, string $name, string $description, string $image, bool $isActive, string $endDate,
                                int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->isActive = $isActive;
        $this->endDate = $endDate;
        $this->currentPrice = $currentPrice;
        $this->directBidPrice1 = $directBidPrice1;
        $this->directBidPrice2 = $directBidPrice2;
        $this->directBidPrice3 = $directBidPrice3;
    }

    public static function create(string $name, string $description, string $image, bool $isActive, string $endDate,
                                  int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3): Article
    {
        return new self(uniqid(), $name, $description, $image, $isActive, $endDate, $currentPrice, $directBidPrice1, $directBidPrice2, $directBidPrice3);
    }

    public static function edit(string $id, string $name, string $description, string $image, bool $isActive, string $endDate,
                                int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3): Article
    {
        return new self($id, $name, $description, $image, $isActive, $endDate, $currentPrice, $directBidPrice1, $directBidPrice2, $directBidPrice3);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
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
            'description' => $this->description(),
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
