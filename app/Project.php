<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'SEGOBRA';

    protected $connection = 'sqlsrv';

    protected $primaryKey = 'SEOBId';

    public function distrito() {
        return $this->hasOne('App\Distrito','CiuId','CiuId');
    }

    public function departamento() {
        return $this->hasOne('App\Departamento','DptoId','DptoId');
    }

    public function estado() {
        return $this->hasOne('App\Estado','value','SEOBEst');
    }

    public function terreno() {
        return $this->hasOne('App\Terreno','ident','SEOBTerr');
    }
}
