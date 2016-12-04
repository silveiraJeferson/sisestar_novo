<?php

namespace sisestar;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
     protected $fillable = ['numero', 'regiao','referencia','ativo'];
}
