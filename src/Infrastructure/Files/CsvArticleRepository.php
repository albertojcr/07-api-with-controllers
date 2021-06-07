<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\Article\Article;
use IESLaCierva\Domain\Article\ArticleRepository;

class CsvArticleRepository implements ArticleRepository
{
    private array $articles;

    public function __construct() {

        $file = fopen(__DIR__ . '/articles.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            $article = $this->hydrate($data);
            $this->articles[$article->id()] = $article;
        }

        fclose($file);
    }

    public function findAll(): array
    {
        return array_values($this->articles);
    }

    public function findById(string $id): ?Article
    {
        foreach ($this->articles as $article) {
            if ($article->id() === $id) {
                return $article;
            }
        }

        return null;
    }

    public function save(Article $article): void
    {
        $file = fopen(__DIR__ . '/articles.csv', "a");
        if (false === $file) {
            throw new Exception('File not found');
        }
        fputcsv($file, [
            $article->id(), $article->name(), $article->description(), $article->image(), $article->isActive(), $article->endDate(), $article->currentPrice(),
            $article->directBidPrice1(), $article->directBidPrice2(), $article->directBidPrice3()
        ]);
        fclose($file);
    }


    private function hydrate($data): Article
    {
        return new Article(
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
            $data[5],
            $data[6],
            $data[7],
            $data[8],
            $data[9]
        );
    }

    public function edit(Article $article): void
    {
        $file = fopen(__DIR__ . '/articles.csv', "a");
        if (false === $file) {
            throw new Exception('File not found');
        }
        $articlesNotMatched = array();

        foreach ($this->articles as $item) {
            if ($item->id() != $article->id()) {
                array_push($articlesNotMatched, [
                    $item->id(), $item->name(), $item->description(), $item->image(), $item->isActive(), $item->endDate(), $item->currentPrice(),
                    $item->directBidPrice1(), $item->directBidPrice2(), $item->directBidPrice3()
                ]);
            }
        }
        $str = file_get_contents($file);
        $numCharSpace = strlen($str);
        ftruncate($file, $numCharSpace);

        fputcsv($file, [
            $article->id(), $article->name(), $article->description(), $article->image(), $article->isActive(), $article->endDate(), $article->currentPrice(),
            $article->directBidPrice1(), $article->directBidPrice2(), $article->directBidPrice3()
        ]);

        foreach ($articlesNotMatched as $item) {
            fputcsv($file, $item);
        }

        fclose($file);
    }
}
