<?php

namespace IESLaCierva\Entrypoint\Controllers\Article;

use IESLaCierva\Application\Article\CreateNewArticle\CreateNewArticleService;
use IESLaCierva\Infrastructure\Files\CsvArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateArticleController
{
    private CreateNewArticleService $service;

    public function __construct()
    {
        $this->service = new CreateNewArticleService(new CsvArticleRepository());
    }

    public function execute(Request $request): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $this->service->execute($data['name'], $data['description'], $data['image'], $data['isActive'], $data['endDate'], $data['currentPrice'], $data['directBidPrice1'], $data['directBidPrice2'], $data['directBidPrice3']);
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
