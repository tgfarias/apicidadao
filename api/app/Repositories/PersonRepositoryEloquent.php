<?php

namespace App\Repositories;

use App\Models\Person;

class PersonRepositoryEloquent implements PersonRepositoryInterface
{
    private $model;

    public function __construct(Person $person)
    {
        $this->model = $person;
    }

    public function index()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }

    public function show($cpf)
    {
        return $this->model::where('cpf', '=', $cpf)->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $cpf)
    {

        $person = $this->model::where('cpf', '=', $cpf)->firstOrFail();
        $person->update($data);
        return $person;

    }

    public function destroy($cpf)
    {
        $person = $this->model::where('cpf', '=', $cpf)->firstOrFail();
        return $person->destroy($person->id);
    }
}
