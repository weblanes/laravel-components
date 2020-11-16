<?php


namespace Weblanes\Laravel\Components\Http\Controllers;


use Illuminate\Http\Request;

trait HasDefaultUpdateRequest
{
    protected function updateRequest(): string
    {
        return Request::class;
    }
}