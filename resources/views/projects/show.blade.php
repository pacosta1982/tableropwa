@extends('adminlte::page')

@section('titulo')
<div class="col-sm-6">
        <h1>Resumen Proyecto</h1>
</div>
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item">
          <a href="{!! action('HomeController@index', ['progid' => $progid,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','proyname' => $proyname,
          'satname' => $satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}">
            Proyectos
          </a>
        </li>
        <li class="breadcrumb-item active">{{substr($project->SEOBProy,0,50) }}</li>
    </ol>
</div>
@endsection

@section('content')

<section class="invoice">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> {{utf8_encode($project->SEOBProy) }}
          <small class="pull-right"><strong>w</strong></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div class="row invoice-info">
        <div class="col-md-4 invoice-col">
          <address>
              SAT: {{$project->SEOBEmpr}}<br>
              Departamento: {!! $project->DptoId?$project->departamento->DptoNom:"" !!}<br>
              Distrito: {!! $project->CiuId?$project->distrito->CiuNom:"" !!}<br>
              Expediente: <a href="{!! action('HomeController@showexp', ['id'=>$project->SEOBId,'NroExpS'=>$project->SEOBNroExpS,'idexp'=>$project->SEOBNroExp,'progid' => $progid
                  ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1','proyname' => $proyname,
    'satname' => $satname,'adminid' =>$adminid,'metaid' =>$metaid,'porcentajeid' =>$porcentajeid]) !!}">{{(substr($project->SEOBNroExp,0,-2)).'-'.(substr($project->SEOBNroExp,-2))}}</a><br>
              Estado: {!! $project->SEOBEst !!}<br>
              Total Casas: {{$project->SEOBViv}}<br>
              Total Avance: {!! number_format($project->SEOBFisAva,0,'.','.')  !!}%<br>
              Avance: <div class="progress progress-lg" >
                        @if ($project->SEOBFisAva >= 70)
                        <div class="progress-bar bg-success" style="width: {{ $project->SEOBFisAva}}% "></div>
                        @endif

                        @if ($project->SEOBFisAva <= 40)
                        <div class="progress-bar bg-danger" style="width: {{ $project->SEOBFisAva}}%"></div>
                        @endif

                        @if ($project->SEOBFisAva >= 41 && $project->SEOBFisAva <= 69)
                        <div class="progress-bar bg-warning" style="width: {{ $project->SEOBFisAva}}%"></div>
                        @endif
                      </div>
          </address>
          
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-8 invoice-col">

            <div style="width: 100%; height: 180px;">
                            {!! Mapper::render() !!}
                        </div>
        </div>
        <!-- /.col -->
      </div>
      
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item active"><a class="nav-link" href="#activity" data-toggle="tab">Observaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Observaciones Fonavis</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      @include('projects.tabs.observaciones')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                      @if($project->SEOBPtoNro)
                        @include('projects.tabs.observacionesfonavis')
                      @endif
        
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
