<?php

namespace App\Exports;

use App\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProjectExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct(string $progid, string $dptoid, string $estadoid, string $searchTerm,
    string $searchTermsat, string $admin, string $meta, string $porcentaje)
    {

        $this->dptoid = $dptoid;
        $this->progid = $progid;
        $this->estadoid = $estadoid;
        $this->searchTerm = $searchTerm;
        $this->searchTermsat = $searchTermsat;
        $this->admin = $admin;
        $this->meta = $meta;
        $this->porcentaje = $porcentaje;
    }

    public function query()
    {
        //return Project::query()
        $projects = Project::query();
        //->select('DENroLin','DEFecDis')
        if ($this->progid != '0') {
            $projects = $projects->where('SEOBProgr', $this->progid);
        }

        if ($this->dptoid != '0' ) {
            $projects = $projects->where('DptoId', $this->dptoid);
        }

        if ($this->estadoid != '0' ) {
            $projects = $projects->where('SEOBEst', $this->estadoid);
        }

        if ($this->searchTerm != '0' ) {
            $projects = $projects->where('SEOBProy', 'LIKE', "%{$this->searchTerm}%");
        }

        if ($this->searchTermsat != '0' ) {
            $projects = $projects->where('SEOBEmpr', 'LIKE', "%{$this->searchTermsat}%");
        }

        if ($this->admin != '0' ) {
            $projects = $projects->where('SEOBAdmin', $this->admin);
        }

        if ($this->meta != '0' ) {
            $projects = $projects->where('SEOBPlan', $this->meta);
        }

        if ($this->porcentaje != '0' ) {
            if ($this->porcentaje == 1 ){
                $projects = $projects->where('SEOBFisAva','<=', 25);
            }

            if ($this->porcentaje == 2 ){
                $projects = $projects->where('SEOBFisAva','>=', 26);
                $projects = $projects->where('SEOBFisAva','<=', 50);
            }

            if ($this->porcentaje == 3 ){
                $projects = $projects->where('SEOBFisAva','>=', 51);
                $projects = $projects->where('SEOBFisAva','<=', 75);
            }

            if ($this->porcentaje == 4 ){
                $projects = $projects->where('SEOBFisAva','>=', 76);
            }
        }





        //$projects = $projects->get();
        return $projects;
        /*->where('NroExp',$this->idexp)
        ->where('NroExpS',$this->serie)
        ->orderBy('DENroLin', 'asc');*/
        //->get();
    }

    public function map($invoice): array
    {

        $array = [
            "A" =>  "Compra de Terreno",
            "P" =>  "Lote Propio",
            "M" =>  "Municipal",
            "I" => "Indert",
            "C" => "Comunitario",
            "SNV" => "Senavitat",
            "G" => "Gobernación",
            "S" => "SAS (Lote Propio)",
            "SSA" => "SAS (Sin Autorización)",
            "F" => "Falta Información",
            "" => "Sin Definir",
        ];

        return [
            rtrim(utf8_encode($invoice->SEOBProy)),
            rtrim(utf8_encode($invoice->SEOBEmpr)),
            $invoice->SEOBViv,
            $array[rtrim(utf8_encode($invoice->SEOBTerr))],
            utf8_encode(rtrim($invoice->CiuId?$invoice->distrito->CiuNom:"")),
            utf8_encode(rtrim($invoice->DptoId?$invoice->departamento->DptoNom:"")),
            //rtrim($invoice->SEOBEst?$invoice->estado->name:""),
            (isset($invoice->SEOBEst))?(rtrim($invoice->CiuId?$invoice->estado->name:"")):'N/A',
            number_format($invoice->SEOBFisAva,0,'.','.').' %',

        ];
    }


    public function headings(): array
    {
        return [
            'Proyecto',
            'Empresa/SAT',
            'Cantidad de Viviendas',
            'Terreno',
            'Distrito',
            'Departamento',
            'Estado',
            'Avance',


        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(18);
                $event->sheet->getStyle('A1:H1')->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('ebebe0');

                        $highestRow = $event->sheet->getHighestRow(); // e.g. 10
                        $highestColumn = $event->sheet->getHighestColumn();

                        for ($i=2; $i <= $highestRow ; $i++) {

                                if ($event->sheet->getCell('H'.$i)->getValue() >= 71) {
                                    $event->sheet->getStyle('A'.$i.':H'.$i)->getFill()
                                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setARGB('00B050');
                                }

                                if ($event->sheet->getCell('H'.$i)->getValue() <= 70 && $event->sheet->getCell('H'.$i)->getValue() >= 31) {
                                    $event->sheet->getStyle('A'.$i.':H'.$i)->getFill()
                                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setARGB('FFFF00');
                                }

                                if ($event->sheet->getCell('H'.$i)->getValue() <= 30) {
                                    $event->sheet->getStyle('A'.$i.':H'.$i)->getFill()
                                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                    ->getStartColor()->setARGB('FF0000');
                                }
                            }
                },
        ];
    }
}
