<?php


namespace IESLaCierva\Application\Article\ValueObject\GetBidsByArticleId;


use IESLaCierva\Domain\Article\Exceptions\BidNotFoundException;
use IESLaCierva\Domain\Article\ValueObject\Bid;
use IESLaCierva\Domain\Article\BidRepository;

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