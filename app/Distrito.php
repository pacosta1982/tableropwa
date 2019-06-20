<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'LOCALIDA';

    protected $primaryKey = 'CiuId';

    protected $connection = 'sqlsrv';

    //protected $connection = 'sqlsrv';
    

    //public $timestamps = false;

    //protected $connection = 'sqlsrv';

    //protected $dateFormat = 'Y-m-d H:i:s.v';

    //public $incrementing = false;
}
