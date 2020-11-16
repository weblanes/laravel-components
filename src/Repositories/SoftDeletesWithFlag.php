<?php


namespace Weblanes\Laravel\Components\Repositories;


trait SoftDeletesWithFlag
{
    /**
     * Returns the name of the boolean attribute used for soft deletion.
     * @return string
     */
    abstract public function softDeleteFlag(): string;

    public function delete(int $id): bool
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model[$this->softDeleteFlag()] = 1;

        $model->save();
    }
}