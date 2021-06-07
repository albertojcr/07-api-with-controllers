<?php

namespace IESLaCierva\Application\Article\CreateNewArticle;

use IESLaCierva\Domain\Article\Article;
use IESLaCierva\Domain\Article\ArticleRepository;
use IESLaCierva\Domain\Article\ValueObject\Email;
use IESLaCierva\Domain\Article\ValueObject\Role;

class CreateNewArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository) {
        $this->articleRepository = $articleRepository;
    }

    public function execute(string $name, string $description, string $image, bool $isActive, string $endDate,
                            int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3)
    {
        $article = Article::create($name, $description, $image, $isActive, $endDate, $currentPrice, $directBidPrice1, $directBidPrice2, $directBidPrice3);
        $this->articleRepository->save($article);
    }
}
