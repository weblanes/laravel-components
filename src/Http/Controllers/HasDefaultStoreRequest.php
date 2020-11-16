<?php


namespace Weblanes\Laravel\Components\Http\Controllers;


use Illuminate\Http\Request;

trait HasDefaultStoreRequest
{
    protected function storeRequest(): string
    {
        return Request::class;
    }
}