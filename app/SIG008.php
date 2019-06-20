<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIG008 extends Model
{
    protected $table = 'SIG008';

    protected $primaryKey = 'DepenCod';

    protected $connection = 'sqlsrv';

    /*public function distrito() {
        return $this->hasOne('App\Distrito','CiuId','CiuId');
    }

    public function departamento() {
        return $this->hasOne('App\Departamento','DptoId','DptoId');
    }*/
}
