<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    protected $table = 'persons';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'lastname',
        'cpf',
        'phone',
        'email',
        'cellphone',
        'postalcode',
        'plane',
        'district',
        'city',
        'state'
    ];

}
