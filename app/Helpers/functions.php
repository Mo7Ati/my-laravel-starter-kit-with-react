<?php

function getPanel(): string
{
    if (isAdminPanel()) {
        return 'admin';
    }
    if (isStorePanel()) {
        return 'store';
    }
    return 'default';
}
function isAdminPanel(): bool
{
    return request()->is(['admin', 'admin/*']);
}

function isStorePanel(): bool
{
    return request()->is(['store', 'store/*']);
}
