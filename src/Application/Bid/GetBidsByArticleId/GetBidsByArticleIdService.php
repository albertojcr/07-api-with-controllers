<?php


namespace IESLaCierva\Application\Bid\GetBidsByArticleId;


use IESLaCierva\Domain\Bid\Exceptions\BidNotFoundException;
use IESLaCierva\Domain\Bid\Bid;
use IESLaCierva\Domain\Bid\BidRepository;

class GetBidsByArticleIdService
{
    private BidRepository $bidRepository;

    public function __construct(BidRepository $bidRepository) {
        $this->bidRepository = $bidRepository;
    }
    public function execute(string $id): array {
        $bid =  $this->bidRepository->findByArticleId($id);

        if ($bid === null) {
            throw new BidNotFoundException();
        }

        return $bid;
    }
}