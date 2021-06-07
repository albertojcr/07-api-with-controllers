<?php


namespace IESLaCierva\Domain\Bid;


class Bid implements \JsonSerializable
{
    private string $bidId;
    private string $articleId;
    private string $price;
    private string $createdAtDateTime;

    public function __construct(string $bidId, string $articleId, string $price, string $createdAtDateTime)
    {
        $this->bidId = $bidId;
        $this->articleId = $articleId;
        $this->price = $price;
        $this->createdAtDateTime = $createdAtDateTime;
    }

    public static function create(string $articleId, string $price, string $createdAtDateTime): Bid
    {
        return new self(uniqid(), $articleId, $price, $createdAtDateTime);
    }

    /**
     * @return string
     */
    public function bidId(): string
    {
        return $this->bidId;
    }

    /**
     * @return string
     */
    public function articleId(): string
    {
        return $this->articleId;
    }

    /**
     * @return string
     */
    public function price(): string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function createdAtDateTime(): string
    {
        return $this->createdAtDateTime;
    }

    public function jsonSerialize()
    {
        return [
            'bidId' => $this->bidId(),
            'articleId' => $this->articleId(),
            'price' => $this->price(),
            'createdAtDateTime' => $this->createdAtDateTime()
        ];
    }
}