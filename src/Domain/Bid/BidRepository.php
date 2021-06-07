<?php


namespace IESLaCierva\Domain\Bid;

use IESLaCierva\Domain\Bid\Bid;

interface BidRepository
{

    public function findAll(): array;

    public function findByArticleId(string $id): array;

    public function save(Bid $bid): void;
}