<?php


namespace IESLaCierva\Entrypoint\Controllers\Bid;


use IESLaCierva\Application\Bid\GetBidsByArticleId\GetBidsByArticleIdService;
use IESLaCierva\Infrastructure\Files\CsvBidRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetBidsByArticleIdController
{
    public function __construct()
    {
        $this->service = new GetBidsByArticleIdService(new CsvBidRepository());
    }

    public function execute(Request $request): Response
    {
        $articleId = $request->get('id');
        $article = $this->service->execute($articleId);
        return new JsonResponse($article);
    }
}