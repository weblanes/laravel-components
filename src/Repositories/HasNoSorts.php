<?php


namespace Weblanes\Laravel\Components\Repositories;


trait HasNoSorts
{
    protected function sorts(): array
    {
        return [];
    }
}