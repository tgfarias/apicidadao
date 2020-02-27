<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $table = 'contacts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'person_id',
        //'type',
        'phone',
        'email',
        'cellphone',
    ];

    public function person()
    {
        return $this->belongsTo('\App\Models\Person', 'person_id', 'id');
    }

}
