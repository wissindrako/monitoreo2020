<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votos_Presidenciales_r extends Model
{
    protected $table = 'votos_presidenciales_r';
    protected $primaryKey = 'id_votos_presidenciales_r';
    /**
     * Get the Mesa that owns the Votos restantes.
    */
    public function Mesa()
    {
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
        return $this->belongsTo('App\Mesa', 'id_mesa', 'id_mesa');
    }
}
