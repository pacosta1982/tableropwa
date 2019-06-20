@extends('adminlte::page')

@section('titulo')
<div class="col-sm-6">
        <h1>Mapa de Proyectos</h1>
</div>
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item active">Mapa</li>
    </ol>
</div>
@endsection


@section('content')

<div class="box box-primary">

        <div class="box-body">
                <form action="/filtrosmapa" method="post">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <h3 class="box-title"><i class="fa fa-globe"></i> Mapa de Proyectos</h3>
                          </div>

              <!-- /.card-header -->
              <div class="box-body">
                    <div style="width: 100%; height: 600px;">
                            {!! Mapper::render() !!}
                        </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


@endsection