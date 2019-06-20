@extends('adminlte::page')

@section('titulo')
<div class="col-sm-6">
        <h1>Detalle Expediente</h1>
</div>
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item">
          <a href="{!! action('HomeController@index', ['progid' => $progid,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','proyname' => $proyname,'satname' => $satname]) !!}">
            Proyectos
          </a>
        </li>
        <li class="breadcrumb-item active">Exp</li>
    </ol>
</div>
@endsection

@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Expediente N° {{(substr($expediente->NroExp,0,-2)).'-'.(substr($expediente->NroExp,-2))}} Serie: {!! $expediente->NroExpS !!}
            <a href="{!! action('HomeController@show', ['id'=>$proy,'idexp'=>$expediente->NroExp,'progid' => $progid,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','proyname' => $proyname,'satname' => $satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}">
                <button type="button" class="btn btn-primary btn-sm  pull-right" style="margin-bottom:10px;"><i class="fa fa-mail-reply"></i>
                  <strong>Volver</strong> 
                </button>
              </a>
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <div class="row invoice-info">
          <div class="col-md-6 invoice-col">
            <address>
                Solicitante: {!! $expediente->NroExpsol !!}<br>
                Solicitud: {!! $expediente->NroExpCon !!}<br>
            </address>
            
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
          <div class="col-md-6 invoice-col">
              <address>
              Recibido por: {!! $expediente->NUsuNombre !!}<br>
              Fecha de Solicitud: {!! date('d/m/Y H:i', strtotime($expediente->NroExpFch)) !!}<br>
              Tipo Expediente: {!! $expediente->TexCod?$expediente->tiposol->TexDes:"" !!}<br>
              </address>
          </div>
          <!-- /.col -->
        </div>
        <a href="{!! action('HomeController@csvhistorial', ['NroExpS'=>$expediente->NroExpS,'idexp'=>$expediente->NroExp]) !!}"><button type="button" class="btn btn-success  pull-right"><i class="fa fa-file-excel-o"></i>
          Exportar Historial
        </button></a>
        
<div class="row">

  <div class="col-md-12">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item active"><a class="nav-link" href="#activity" data-toggle="tab">Historial Expediente</a></li>
            
            <!--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
          </ul>
          
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                @include('projects.tabs.historial')
            </div>
            <!-- /.tab-pane -->
            <div class=" tab-pane" id="timeline">

                @include('projects.tabs.timeline')
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
              
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
  </section>
@endsection

@section('javascript')
<!-- jQuery -->

@stop