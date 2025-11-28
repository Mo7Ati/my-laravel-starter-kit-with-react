<?php

namespace App\Enums;

enum PanelsEnum: string
{
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
        };
    }
}
