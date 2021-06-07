<?php

namespace IESLaCierva\Entrypoint\Controllers\Bid;

use IESLaCierva\Application\Bid\CreateBid\CreateBidService;
use IESLaCierva\Infrastructure\Files\CsvBidRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateBidController
{
    private CreateBidService $service;

    public function __construct()
    {
        $this->service = new CreateBidService(new CsvBidRepository());
    }

    public function execute(Request $request): Response
    {
        $articleId = $request->get('id');
        $json = $request->getContent();
        $data = json_decode($json, true);
        $this->service->execute($articleId, $data['price'], $data['createdAtDateTime']);
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
