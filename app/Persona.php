<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'id_persona';
    public $timestamps = false;

    /**
     * Get the User record associated with the Person.
     */
    public function usuario()
    {
        return $this->hasOne('App\User', 'id_persona', 'id_persona');
    }

    /**
     * Get the User record associated with the Person.
     */
    public function recinto()
    {
        return $this->belongsTo('App\Recinto', 'id_recinto', 'id_recinto');
    }
}
