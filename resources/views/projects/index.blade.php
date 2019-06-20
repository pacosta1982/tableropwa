@extends('adminlte::page')

@section('titulo')
<div class="col-sm-6">
        <h1>Proyectos</h1>
</div>
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active">Proyectos</li>
    </ol>
</div>
@endsection


@section('content')
@php


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


@endphp
<div class="box box-primary">

    <div class="box-body">
            <form action="/filtros" method="post">
                @csrf
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label>Programa</label>
                    <select class="form-control required" name="progid" id="user_id">
                        <option value="" >Seleccione una opción</option>
                        @foreach($programas as $us)

                        <option value="{{$us->value}}"
                         @if ($progid == $us->value)
                            selected="selected"
                          @endif
                            >{{$us->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Departamento</label>
                    <select class="form-control required" name="dptoid" id="dptoid">
                        <option value="" >Seleccione una opción</option>
                        @foreach($departamentos as $dpt)

                        <option value="{{$dpt->DptoId}}"
                         @if ($dptoid == $dpt->DptoId)
                            selected="selected"
                          @endif
                            >{{$dpt->DptoNom}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Estado</label>
                    <select class="form-control required" name="estadoid" id="estadoid">
                        <option value="" >Seleccione una opción</option>
                        @foreach($estados as $est)

                        <option value="{{$est->value}}"
                         @if ($estadoid == $est->value)
                            selected="selected"
                          @endif
                            >{{$est->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                            <label>Meta</label>
                            <select class="form-control required" name="metaid" id="metaid">
                                <option value="" >Seleccione una opción</option>
                                @foreach($metas as $met)

                                <option value="{{$met->value}}"
                                 @if ($metaid == $met->value)
                                    selected="selected"
                                  @endif
                                    >{{$met->name}} </option>
                                @endforeach
                            </select>
                        </div>
               <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Expediente</label>
                <input type="text" class="form-control" id="expnro" name="expnro" value="{{$expnro}}" placeholder="Ingrese N° de Expediente">
                </div> -->

            </div>
        </div>
        <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Proyecto</label>
                        <input type="text" class="form-control" id="proyname" name="proyname" value="{{$proyname}}" placeholder="Ingrese Nombre de Proyecto">

                    </div>
                    <h4 class="box-title">Total Proyectos: {{ $projects->total() }}</h4>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">SAT/EMPRESA</label>
                        <input type="text" class="form-control" id="satname" name="satname" value="{{$satname}}" placeholder="Ingrese Nombre de SAT/Empresa">
                    </div>
                    <a href="{!! action('HomeController@downloadproject', ['progid' => $progid
                        ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','expnro' =>$expnro,'proyname' =>$proyname,
                        'satname' =>$satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}"><button type="button" class="btn btn-success  float-left"><i class="fa fa-file-excel-o"></i>
              Exportar
            </button></a>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Administración</label>
                        <select class="form-control required" name="adminid" id="adminid">
                            <option value="" >Seleccione una opción</option>
                            @foreach($administracion as $adm)

                            <option value="{{$adm->value}}"
                             @if ($adminid == $adm->value)
                                selected="selected"
                              @endif
                                >{{$adm->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Avance %</label>
                                <select class="form-control required" name="porcentajeid" id="porcentajeid">
                                    <option value=""  >Seleccione una opción</option>
                                    <option value="1" {{ old('progid',isset($porcentajeid)?$porcentajeid:'') == '1' ? "selected":""}} >0% - 25%</option>
                                    <option value="2" {{ old('progid',isset($porcentajeid)?$porcentajeid:'') == '2' ? "selected":""}}>26% - 50%</option>
                                    <option value="3" {{ old('progid',isset($porcentajeid)?$porcentajeid:'') == '3' ? "selected":""}}>51% - 75%</option>
                                    <option value="4" {{ old('progid',isset($porcentajeid)?$porcentajeid:'') == '4' ? "selected":""}}>76% - 100%</option>

                                </select>
                            </div>
                        <button type="submit" class="btn btn-primary pull-right">Buscar</button>
                </div>

            </div>
    </div>
</form>
<!-- /.card-body -->
</div>



    <div class="box box-primary">
            <div class="box-header with-border">

              <div class="pull-right">{{ $projects->appends(request()->except('_token'))->links() }}</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <th style="width: 20px">Exp.</th>
                  <th>Proyecto</th>
                  <th>Empresa/Sat</th>
                  <th>AMB</th>
                  <th>SOC</th>
                  <th>TEC</th>
                  <th style="text-align:center;">Cantidad de Viviendas</th>
                  <th style="text-align:center;">Terreno</th>
                  <th>Distrito</th>
                  <th>Departamento</th>
                  <th style="text-align:center;">Estado</th>

                  <th style="width: 40px">Avance</th>
                </tr>
                @foreach($projects as $project)
                <tr>
                <td style="text-align:center;"><a href="{!! action('HomeController@showexp', ['id'=>$project->SEOBId,'NroExpS'=>$project->SEOBNroExpS,'idexp'=>$project->SEOBNroExp,'progid' => $progid
                        ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','expnro' =>$expnro,'proyname' =>$proyname,
                        'satname' =>$satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}">{{(substr($project->SEOBNroExp,0,-2)).'-'.(substr($project->SEOBNroExp,-2))}}</a></td>
                <td><a href="{!! action('HomeController@show', ['id'=>$project->SEOBId,'progid' => $progid
                        ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','expnro' =>$expnro,'proyname' =>$proyname,
                        'satname' =>$satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}">{{utf8_encode($project->SEOBProy)}}</a></td>
                <td>{{utf8_encode($project->SEOBEmpr)}}</td>
                <td style="text-align:center;">
                    @if($project->SEOBVTA == 'S')
                    <i class="fa fa-check" style="color:forestgreen"></i>
                    @else
                    <i class="fa fa-warning" style="color:darkorange"></i>
                    @endif
                </td>
                <td style="text-align:center;">
                    @if($project->SEOBInfS == 'S')
                    <i class="fa fa-check" style="color:forestgreen"></i>
                    @else
                    <i class="fa fa-warning" style="color:darkorange"></i>
                    @endif
                </td>
                <td style="text-align:center;">
                    @if($project->SEOBEvTe == 'S')
                    <i class="fa fa-check" style="color:forestgreen"></i>
                    @else
                    <i class="fa fa-warning" style="color:darkorange"></i>
                    @endif
                </td>
                <td style="text-align:center;">{{$project->SEOBViv}}</td>
                <td style="text-align:center;">{!! $array[rtrim($project->SEOBTerr)]!!}</td>
                <td>{!! $project->CiuId?$project->distrito->CiuNom:"" !!}</td>
                <td>{!! $project->DptoId?$project->departamento->DptoNom:"" !!}</td>
                <td style="text-align:center;">{!! $project->SEOBEst?$project->estado->name:"" !!}</td>

                <td style="text-align:center;">
                    @if ($project->SEOBFisAva >= 69)
                        <span class="badge bg-green">
                    @endif
                    @if ($project->SEOBFisAva <= 40)
                        <span class="badge bg-red">
                    @endif
                    @if ($project->SEOBFisAva >= 41 && $project->SEOBFisAva <= 69)
                        <span class="badge bg-yellow">
                    @endif
                        {{ number_format($project->SEOBFisAva,0,'.','.') }}%
                    </span>
                </td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.card-body -->
          </div>

@endsection

@section('javascript')
<!-- jQuery -->

@stop
