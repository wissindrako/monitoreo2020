<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //unidades
    protected $primaryKey = 'idarea';

    public function unidades() {
        return $this->hasMany('App\Unidad', 'idunidad', 'id');
    }
}
