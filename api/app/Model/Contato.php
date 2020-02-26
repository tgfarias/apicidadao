<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cidadao extends Model {
    
    protected $table = 'contatos';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'cidadao_id',
        'tipo',
        'contato'
    ];

    public function cidadao()
    {
        return $this->belongsTo('Cidadao');
    }

}