<?php


namespace Weblanes\Laravel\Components\Validation\Contracts;


use Illuminate\Http\Request;

interface RequestValidationInterface
{
    /**
     * Returns the validation rules to be applied to the request.
     *
     * @param Request $request
     * @return array
     */
    public function validationRules(Request &$request): array;

    /**
     * Returns custom messages for validation errors.
     *
     * @return array
     */
    public function validationMessages(): array;
}