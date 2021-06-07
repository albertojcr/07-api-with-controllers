<?php

namespace IESLaCierva\Application\Bid\CreateBid;

use IESLaCierva\Domain\Bid\BidRepository;
use IESLaCierva\Domain\Bid\Bid;

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
