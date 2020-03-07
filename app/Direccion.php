<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    
    public function ministerios() {
        return $this->hasMany('App\Ministerio', 'id', 'id_min');
    }
}
