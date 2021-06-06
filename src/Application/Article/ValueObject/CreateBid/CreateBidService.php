<?php

namespace IESLaCierva\Application\Article\ValueObject\CreateBid;

use IESLaCierva\Domain\Article\BidRepository;
use IESLaCierva\Domain\Article\ValueObject\Bid;
use IESLaCierva\Domain\Article\ValueObject\Email;
use IESLaCierva\Domain\Article\ValueObject\Role;

class CreateBidService
{
    private BidRepository $bidRepository;

    public function __construct(BidRepository $bidRepository) {
        $this->bidRepository = $bidRepository;
    }

    public function execute(string $articleId, string $price, string $createdAtDateTime)
    {
        $bid = Bid::create($articleId, $price, $createdAtDateTime);
        $this->bidRepository->save($bid);
    }
}
