<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\User\ValueObject\Bid;
use IESLaCierva\Domain\User\BidRepository;

class BidsRepository implements BidRepository
{
    private array $bids;

    public function __construct() {

        $file = fopen(__DIR__.'/bids.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            $bid = $this->hydrate($data);
            $this->bids[$bid->id()] = $bid;
        }

        fclose($file);
    }
/*
    public function findAll(): array
    {
        return array_values($this->users);
    }
*/
    public function findByArticleId(string $articleId): ?Bid
    {
        foreach ($this->bids as $bid) {
            if ($bid->articleId() === $articleId) {
                return $bid;
            }
        }

        return null;
    }
/*
    public function save(User $user): void
    {
        $file = fopen(__DIR__.'/users.csv', "a");
        if (false === $file) {
            throw new Exception('File not found');
        }
        fputcsv($file, [
            $user->id(), $user->name(), $user->image(), $user->isActive(), $user->endDate(), $user->currentPrice(),
            $user->directBidPrice1(), $user->directBidPrice2(), $user->directBidPrice3()
        ]);
        fclose($file);
    }
*/
    private function hydrate($data): Bid
    {
        return new Bid(
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
            $data[5],
            $data[6],
            $data[7],
            $data[8]
        );
    }

}
