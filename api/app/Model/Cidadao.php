<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cidadao extends Model {
    
    protected $table = 'cidadaos';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];

    public function contatos()
    {
        return $this->hasMany('Contato');
    }
}