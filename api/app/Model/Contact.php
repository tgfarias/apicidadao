<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $table = 'contacts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'person_id',
        'type',
        'contact'
    ];

    public function person()
    {
        return $this->belongsTo('Person');
    }

}
