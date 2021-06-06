<?php

namespace IESLaCierva\Application\Article\GetArticleById;

use IESLaCierva\Domain\Article\Exceptions\ArticleNotFoundException;
use IESLaCierva\Domain\Article\Article;
use IESLaCierva\Domain\Article\ArticleRepository;

class GetArticleByIdService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository) {
        $this->articleRepository = $articleRepository;
    }
    public function execute(string $id): Article {
        $article =  $this->articleRepository->findById($id);

        if ($article === null) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }
}
