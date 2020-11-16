<?php


namespace Weblanes\Laravel\Components\Repositories;


use Weblanes\Laravel\Components\Repositories\Contracts\RepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    private $application;

    /**
     * Repository constructor.
     * @param Application $application
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function __construct(Application $application)
    {
        $this->application = $application;

        $this->make($this->model());
    }

    /**
     * Returns the name of the class representing the model.
     * @return string
     */
    abstract protected function model(): string;

    /**
     * Returns an array of filterable attributes.
     * @return array
     */
    abstract protected function filters(): array;

    /**
     * Returns an array of allowed relations.
     * @return array
     */
    abstract protected function includes(): array;

    /**
     * Returns an array of sortable attributes;
     * @return array
     */
    abstract public function sorts(): array;

    public function search(): LengthAwarePaginator
    {
        $query = QueryBuilder::for($this->model());

        $filters = $this->filters();
        $includes = $this->includes();
        $sorts = $this->sorts();

        if (count($filters) > 0)
            $query->allowedFilters($filters);

        if (count($includes) > 0)
            $query->allowedIncludes($includes);

        if (count($sorts) > 0)
            $query->allowedSorts($sorts);

        return $query->paginate();
    }

    public function findById(int $id): Model
    {
        $query = QueryBuilder::for($this->model());

        $includes = $this->includes();

        if (is_array($includes) && count($includes) > 0)
            $query->allowedIncludes($includes);

        return $query->findOrFail($id);
    }

    public function create(array $payload): Model
    {
        $model = $this->model->newInstance($payload);

        $model->save();

        return $model;
    }

    public function update(int $id, array $payload): Model
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->update($payload);

        return $model;
    }

    abstract public function delete(int $id): bool;

    /**
     * @param $model
     * @return Model
     * @throws BindingResolutionException
     * @throws Exception
     */
    private function make($model)
    {
        try {
            $model = $this->application->make($model);
        } catch (BindingResolutionException $e) {
            throw $e;
        }

        if (!$model instanceof Model) {
            throw new Exception("Class {$model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }
}