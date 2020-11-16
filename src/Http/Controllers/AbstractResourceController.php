<?php


namespace Weblanes\Laravel\Components\Http\Controllers;

use Weblanes\Laravel\Components\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

abstract class AbstractResourceController extends Controller
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * ApiRepositoryController constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns the name of the class representing store request.
     * It must be of type Illuminate\Http\Request.
     * @return string
     */
    abstract protected function storeRequest(): string;

    /**
     * Returns the name of the class representing update request.
     * It must be of type Illuminate\Http\Request.
     * @return string
     */
    abstract protected function updateRequest(): string;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return new Response(
            $this->repository->search()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = app($this->storeRequest());

        return new Response(
            $this->repository->create(
                $request->all()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        return new Response(
            $this->repository->findById($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(int $id)
    {
        $request = app($this->updateRequest());

        return new Response(
            $this->repository->update(
                $id, $request->all()
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->repository->delete($id);

        return (new Response())->setStatusCode(204);
    }
}