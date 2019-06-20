<?php

namespace App\Exports;

use App\SIG006;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistorialExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $idexp, string $serie)
    {
        $this->idexp = $idexp;
        $this->serie = $serie;
    }

    public function query()
    {
        return SIG006::query()
        //->select('DENroLin','DEFecDis')
        ->where('NroExp',$this->idexp)
        ->where('NroExpS',$this->serie)
        ->orderBy('DENroLin', 'asc');
        //->get();
    }

    public function map($invoice): array
    {
        return [
            $invoice->DENroLin,
            date('d/m/Y', strtotime($invoice->DEFecDis)),
            rtrim($invoice->DEUnOrHa?$invoice->deporigen->DepenDes:""),
            rtrim($invoice->DEUnOrHa?$invoice->depdestino->DepenDes:""),
            $invoice->DEExpEst,
            date('d/m/Y', strtotime($invoice->DEFecRcp)),
            $invoice->DERcpNam,
            $invoice->DEExpAcc,
            //$invoice->DEUnOrHa?$invoice->deporigen->DepenDes:"",
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }


    public function headings(): array
    {
        return [
            'Linea',
            'Fecha',
            'Origen',
            'Destino',
            'Estado',
            'Fecha Recepcion',
            'Recepcionado por',
            'Observacion',
            
        ];
    }
}
