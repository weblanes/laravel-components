<?php


namespace Weblanes\Laravel\Components\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function search() : LengthAwarePaginator;

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id) : Model;

    /**
     * @param array $payload
     * @return Model
     */
    public function create(array $payload) : Model;

    /**
     * @param int $id
     * @param array $payload
     * @return Model
     */
    public function update(int $id, array $payload) : Model;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;
}