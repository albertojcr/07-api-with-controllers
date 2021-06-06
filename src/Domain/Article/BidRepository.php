<?php


namespace IESLaCierva\Domain\Article;


use IESLaCierva\Domain\Article\ValueObject\Bid;

interface BidRepository
{

    public function findAll(): array;

    public function findByArticleId(string $id): array;

    public function save(Bid $bid): void;
}