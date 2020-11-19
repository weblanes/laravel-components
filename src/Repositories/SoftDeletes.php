<?php


namespace Weblanes\Laravel\Components\Repositories;


trait SoftDeletes
{
    public function delete(int $id): bool
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->delete();

        return true;
    }
}