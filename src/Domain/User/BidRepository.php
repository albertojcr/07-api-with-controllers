<?php


namespace IESLaCierva\Domain\User\ValueObject\Bid;


interface BidRepository
{

    public function findByArticleId(string $id): ?Bid;

    public function save(Bid $bid): void;
}