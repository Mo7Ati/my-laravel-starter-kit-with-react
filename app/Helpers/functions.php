<?php

use App\Enums\PanelsEnum;

function getPanel(): string|null
{
    if (isAdminPanel()) {
        return PanelsEnum::ADMIN->value;
    }
    if (isStorePanel()) {
        return PanelsEnum::STORE->value;
    }
    return null;
}
function isAdminPanel(): bool
{
    return request()->is([PanelsEnum::ADMIN->value, PanelsEnum::ADMIN->value . '/*']);
}

function isStorePanel(): bool
{
    return request()->is([PanelsEnum::STORE->value, PanelsEnum::STORE->value . '/*']);
}
