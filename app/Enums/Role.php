<?php

namespace App\Enums;

enum Role
{
    case ADMIN;
    case USER;

    public function status(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::USER => 'user',
        };
    }
}
