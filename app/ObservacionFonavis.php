<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacionFonavis extends Model
{
    protected $table = 'SEGPROY1';

    protected $connection = 'sqlsrv';

    //protected $primaryKey = 'SEOBId';

    /*public function distrito() {
        return $this->hasOne('App\Distrito','CiuId','CiuId');
    }

    public function departamento() {
        return $this->hasOne('App\Departamento','DptoId','DptoId');
    }*/
}
