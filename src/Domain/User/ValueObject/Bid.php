<?php


namespace IESLaCierva\Domain\User\ValueObject;


class Bid implements \JsonSerializable
{
    private string $bidId;
    private string $articleId;
    private string $price;
    private string $createdAtDate;
    private string $createdAtTime;

    public function __construct(string $bidId, string $articleId, string $price, string $createdAtDate, string $createdAtTime)
    {
        $this->bidId = $bidId;
        $this->articleId = $articleId;
        $this->price = $price;
        $this->createdAtDate = $createdAtDate;
        $this->createdAtTime = $createdAtTime;
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
    public function createdAtDate(): string
    {
        return $this->createdAtDate;
    }

    /**
     * @return string
     */
    public function createdAtTime(): string
    {
        return $this->createdAtTime;
    }

    public function jsonSerialize()
    {
        return [
            'bidId' => $this->bidId(),
            'articleId' => $this->articleId(),
            'price' => $this->price(),
            'createdAtDate' => $this->createdAtDate(),
            'createdAtTime' => $this->createdAtTime()
        ];
    }
}