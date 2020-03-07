<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votos_Uninominales extends Model
{
    protected $table = 'votos_uninominales';
    protected $primaryKey = 'id_votos_uninominales';
    /**
     * Get the Mesa that owns the Votos.
    */
    public function Mesa()
    {
        // return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
        return $this->belongsTo('App\Mesa', 'id_mesa', 'id_mesa');
    }
}
