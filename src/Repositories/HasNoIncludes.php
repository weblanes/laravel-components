<?php


namespace Weblanes\Laravel\Components\Repositories;


trait HasNoIncludes
{
    protected function includes(): array
    {
        return [];
    }
}