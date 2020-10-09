<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonasImport implements ToModel
{
        /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Persona([
            // 'id_persona' => $row[1],
            'nombre' => uscwords($row[2]),
            'paterno' => uscwords($row[3]),
            'materno' => uscwords($row[4]),
            'cedula' => $row[5],
            'comp_ci' => $row[6],
            'exp' => $row[7],
            'fecha_nac' => $row[8],
            'celular' => $row[9],
            'telf_ref' => $row[10],
            'email' => $row[11],
            'direccion' => $row[12],
            'grado_comp' => $row[13],
            'fecha_reg' => $row[14],
            'activo' => $row[15],
            'asignado' => $row[16],
            'id_recinto' => $row[17],
            'id_origen' => $row[18],
            'id_sub_origen' => $row[19],
            'id_resp_reg' => $row[20],
            'id_rol' => $row[21],
            'titularidad' => $row[22],
            'informatico' => $row[23],
            'militancia' => $row[24],
            'id' => $row[25],
        
        ]);
    }
}
