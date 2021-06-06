<?php

namespace IESLaCierva\Domain\Article\Exceptions;

use IESLaCierva\Domain\Exceptions\NotFoundException;

class ArticleNotFoundException extends \Exception implements NotFoundException
{
    public function __construct()
    {
        parent::__construct('Article Not Found Exception');
    }
}
