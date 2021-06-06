<?php

namespace IESLaCierva\Domain\Article\ValueObject;

use IESLaCierva\Domain\Article\Exceptions\RoleNotValid;

class Role
{
    const ADMIN = 'Administrador';
    const EDITOR = 'Editor';
    private string $role;

    public function __construct(string $role)
    {
        if (in_array($role, [self::ADMIN, self::EDITOR]) === false) {
            throw new RoleNotValid($role);
        }

        $this->role = $role;
    }

    public function value(): string
    {
        return $this->role;
    }
}
