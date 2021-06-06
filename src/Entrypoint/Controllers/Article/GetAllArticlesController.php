<?php

namespace IESLaCierva\Entrypoint\Controllers\Article;

use IESLaCierva\Application\Article\GetAllArticles\GetAllArticleService;
use IESLaCierva\Infrastructure\Files\CsvArticleRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllArticlesController
{
    private GetAllArticleService $getAllArticleService;

    public function __construct() {
        $this->getAllArticleService = new GetAllArticleService(new CsvArticleRepository());
    }


    public function execute(Request $request): Response
    {
        $articles = $this->getAllArticleService->execute();
        return new JsonResponse($articles);
    }
}
