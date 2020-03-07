<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    protected $primaryKey = 'id_recinto';

    /**
     * Obtenga las Mesas para el Recinto.
    */

    public function mesas()
    {
        // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasMany('App\Mesa', 'id_recinto', 'id_recinto');
    }

    public function personas()
    {
        // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasMany('App\Persona', 'id_recinto', 'id_recinto');
    }

}
