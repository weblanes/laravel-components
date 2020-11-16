<?php


namespace Weblanes\Laravel\Components\Repositories;


trait PermanentlyDeletes
{
    public function delete(int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->forceDelete();
    }
}