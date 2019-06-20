<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIG006 extends Model
{
    protected $table = 'SIG006';

    protected $connection = 'sqlsrv';

    public function deporigen() {
        return $this->hasOne('App\SIG008','DepenCod','DEUnOrDe');
    }

    public function depdestino() {
        return $this->hasOne('App\SIG008','DepenCod','DEUnOrHa');
    }

    public function getDays($fdate,$tdate){
        //$fdate = $request->Fdate;
        //$tdate = $request->Tdate;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        return $days;
    }

    //protected $primaryKey = 'SEOBId';

    /*public function distrito() {
        return $this->hasOne('App\Distrito','CiuId','CiuId');
    }

    public function departamento() {
        return $this->hasOne('App\Departamento','DptoId','DptoId');
    }*/
}
