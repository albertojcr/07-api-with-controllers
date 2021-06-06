<?php


namespace IESLaCierva\Domain\User;


use IESLaCierva\Domain\User\ValueObject\Bid;

interface BidRepository
{

    public function findAll(): array;

    public function findByArticleId(string $id): ?Bid;

    public function save(Bid $bid): void;
}