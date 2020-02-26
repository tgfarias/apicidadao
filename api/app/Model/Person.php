<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    protected $table = 'persons';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'lastname',
        'cpf',
        'postalcode',
        'plane',
        'district',
        'city',
        'state'
    ];

    public function contacts()
    {
        return $this->hasMany('App\Model\Contact');
    }
}
