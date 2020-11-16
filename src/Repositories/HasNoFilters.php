<?php


namespace Weblanes\Laravel\Components\Repositories;


trait HasNoFilters
{
    protected function filters(): array
    {
        return [];
    }
}