<?php

namespace App\Repositories;

use App\Models\Person;

interface PersonRepositoryInterface
{
    public function __construct(Person $person);
    public function index();
    public function show($cpf);
    public function create(array $data);
    public function update($cpf, array $data);
    public function destroy($cpf);
}
