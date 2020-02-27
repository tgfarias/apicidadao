<?php

namespace App\Models;

class ValidationPerson
{
    const RULE_PERSON = [
        'name' => 'required',
        'lastname' => 'required',
        'cpf' => 'required|cpf|min:11|max:14|unique:persons',
        'postalcode' => 'min:8|max:9',
    ];

}
