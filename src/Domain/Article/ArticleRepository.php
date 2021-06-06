<?php

namespace IESLaCierva\Domain\Article;

interface ArticleRepository
{
    public function findAll(): array;

    public function findById(string $id): ?Article;

    public function save(Article $article): void;
}