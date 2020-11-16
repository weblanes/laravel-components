<?php


namespace Weblanes\Laravel\Components\Models;


trait HasDefaults
{
    protected function table(): string
    {
        return '';
    }

    protected function fillables(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}