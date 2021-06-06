<?php


namespace IESLaCierva\Domain\User;


use IESLaCierva\Domain\User\ValueObject\Bid;

interface BidRepository
{

    public function findAll(): array;

    public function findByArticleId(string $id): array;

    public function save(Bid $bid): void;
}