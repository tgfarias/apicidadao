<?php

namespace App\Models;

class ValidationPerson
{
    const RULE_PERSON = [
        'name' => 'required',
        'lastname' => 'required',
        'cpf' => 'required|cpf|min:11|max:14|unique:persons',
        'postalcode' => 'min:8|max:9',
        'email' => 'nullable|email',
        'phone' => 'nullable|telefone_com_ddd',
        'cellphone' => 'nullable|celular_com_ddd'
    ];

    const RULE_PERSON_UPDATE = [
        'name' => 'required',
        'lastname' => 'required',
        'cpf' => 'required|cpf|min:11|max:14',
        'postalcode' => 'min:8|max:9',
        'email' => 'nullable|email',
        'phone' => 'nullable|telefone_com_ddd',
        'cellphone' => 'nullable|celular_com_ddd'
    ];

    const RULE_CPF = [
        'cpf' => 'required|cpf|min:11|max:14',
    ];

}
