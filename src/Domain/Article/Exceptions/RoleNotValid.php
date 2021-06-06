<?php

namespace IESLaCierva\Domain\Article\Exceptions;

use IESLaCierva\Domain\Exceptions\ParameterNotValid;
use Throwable;

class RoleNotValid extends \Exception implements ParameterNotValid
{

    public function __construct(string $role)
    {
        parent::__construct($role.' is not valid role');
    }
}
