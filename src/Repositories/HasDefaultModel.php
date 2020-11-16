<?php


namespace Weblanes\Laravel\Components\Repositories;


use Illuminate\Database\Eloquent\Model;

trait HasDefaultModel
{
    public function model(): string
    {
        return Model::class;
    }
}