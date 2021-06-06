<?php


namespace IESLaCierva\Application\User\ValueObject\GetBidsByArticleId;


use IESLaCierva\Domain\User\Exceptions\BidNotFoundException;
use IESLaCierva\Domain\User\ValueObject\Bid;
use IESLaCierva\Domain\User\BidRepository;

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