<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Project;

class ViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casas = Project::query();   
        $casas = $casas->select('DptoId', \DB::raw('SUM("SEOBViv") as total'));
        //$casas = $casas->select('DptoId', \DB::raw('SUM(2) as total'))
        $casas = $casas->whereIn('DptoId',[1,8,17,2,3,4,5,6,7,9,10,11,12,13,14,15,16]);
        //$casas = $casas->where('DptoId', 1);
        $casas = $casas->where('SEOBAdmin', 7);
        $casas = $casas->groupBy('DptoId');
        $casas = $casas->orderBy('DptoId', 'asc')->get();

        $arr = [];
        $dto = [];

        $map = Mapper::map(-25.3006592, -57.63591, ['zoom' => 7,'marker' => false,'overlay' => 'TRAFFIC','type' => 'TERRAIN', 'cluster' => false]);
        //$map = Mapper::map(-25.3006592, -57.63591,['zoom' => 6, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 20]]);

        foreach ($casas as $key => $value) {
            //array_push($arr,$value->total);
            //array_push($dto,utf8_encode(rtrim($value->DptoId?$value->departamento->DptoNom:"")));
           //var_dump($value->DptoId?$value->departamento->latitud:"");
            //$planif+=$value->TabGer01VivPla;
            $contentString = '<div id="content" style="
            text-align:center;
            color:black
            
            "><b>'.utf8_encode(rtrim($value->DptoId?$value->departamento->DptoNom:"")).'</b><br>'.
            $value->total.' casas</div>';
            $map =  Mapper::informationWindow($value->DptoId?$value->departamento->latitud:"", $value->DptoId?$value->departamento->longitud:"", $contentString, 
            ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => utf8_encode(rtrim($value->DptoId?$value->departamento->DptoNom:""))]]);
        }

        array_pop($arr);
        array_pop($dto);


        
        $title='';
        
        return view('viviendas.index',compact('map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
