<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\Bid\Exceptions\BidNotFoundException;
use IESLaCierva\Domain\Bid\Bid;
use IESLaCierva\Domain\Bid\BidRepository;

class CsvBidRepository implements BidRepository
{
    private array $bids;

    public function __construct() {

        $file = fopen(__DIR__.'/bids.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            $bid = $this->hydrate($data);
            $this->bids[$bid->bidId()] = $bid;
        }

        fclose($file);
    }

    public function findAll(): array
    {
        return array_values($this->bids);
    }

    public function findByArticleId(string $articleId): array
    {
        $bidsMatchingArticleId = array();
        foreach ($this->bids as $bid) {
            if ($bid->articleId() === $articleId) {
                array_push($bidsMatchingArticleId, $bid);
            }
        }

        if ($bidsMatchingArticleId == null) {
            throw new BidNotFoundException();
        }

        return array_values($bidsMatchingArticleId);
    }

    public function save(Bid $bid): void
    {
        $file = fopen(__DIR__.'/bids.csv', "a");
        if (false === $file) {
            throw new Exception('File not found');
        }
        fputcsv($file, [
            $bid->bidId(), $bid->articleId(), $bid->price(), $bid->createdAtDateTime()
        ]);
        fclose($file);
    }

    private function hydrate($data): Bid
    {
        return new Bid(
            $data[0],
            $data[1],
            $data[2],
            $data[3]
        );
    }

}
