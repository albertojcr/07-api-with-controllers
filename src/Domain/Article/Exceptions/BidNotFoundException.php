<?php

namespace IESLaCierva\Domain\Article\Exceptions;

use IESLaCierva\Domain\Exceptions\NotFoundException;
use Throwable;

class BidNotFoundException extends \Exception implements NotFoundException
{
    public function __construct()
    {
        parent::__construct('Bid Not Found Exception');
    }
}
