<?php


namespace IESLaCierva\Application\Article\EditArticle;


use IESLaCierva\Domain\Article\Article;
use IESLaCierva\Domain\Article\ArticleRepository;

class EditArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository) {
        $this->articleRepository = $articleRepository;
    }

    public function execute(string $id, string $name, string $description, string $image, bool $isActive, string $endDate,
                            int $currentPrice, int $directBidPrice1, int $directBidPrice2, int $directBidPrice3)
    {
        $article = Article::edit($id, $name, $description, $image, $isActive, $endDate, $currentPrice, $directBidPrice1, $directBidPrice2, $directBidPrice3);
        $this->articleRepository->edit($article);
    }
}