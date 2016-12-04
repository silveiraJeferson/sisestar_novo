<?php

namespace sisestar;

use Illuminate\Database\Eloquent\Model;

class Logradouro extends Model
{
    protected $fillable = ['tipo', 'nome', 'ativo'];
}
