<?php

namespace IESLaCierva\Entrypoint\Controllers\Article;

use IESLaCierva\Application\Article\GetArticleById\GetArticleByIdService;
use IESLaCierva\Infrastructure\Files\CsvArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetArticleByIdController
{
    public function __construct()
    {
        $this->service = new GetArticleByIdService(new CsvArticleRepository());
    }

    public function execute(Request $request): Response
    {
        $articleId = $request->get('id');
        $article = $this->service->execute($articleId);
        return new JsonResponse($article);
    }
}
