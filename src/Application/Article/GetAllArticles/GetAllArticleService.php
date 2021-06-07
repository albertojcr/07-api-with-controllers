<?php

namespace IESLaCierva\Application\Article\GetAllArticles;

use IESLaCierva\Domain\Article\ArticleRepository;

class GetAllArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository) {
        $this->articleRepository = $articleRepository;
    }

    public function execute(): array {
        return $this->articleRepository->findAll();
    }
}