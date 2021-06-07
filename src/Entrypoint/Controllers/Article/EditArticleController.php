<?php


namespace IESLaCierva\Entrypoint\Controllers\Article;

use IESLaCierva\Application\Article\EditArticle\EditArticleService;
use IESLaCierva\Infrastructure\Files\CsvArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditArticleController
{
    private EditArticleService $service;

    public function __construct()
    {
        $this->service = new EditArticleService(new CsvArticleRepository());
    }

    public function execute(Request $request): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $this->service->execute($data['id'], $data['name'], $data['description'], $data['image'], $data['isActive'], $data['endDate'], $data['currentPrice'], $data['directBidPrice1'], $data['directBidPrice2'], $data['directBidPrice3']);
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}