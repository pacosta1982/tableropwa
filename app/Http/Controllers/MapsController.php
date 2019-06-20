<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Observacion;
use App\ObservacionFonavis;
use App\Programa;
use App\Departamento;
use App\Administracion;
use App\Estado;
use App\SIG005;
use App\SIG006;
use App\Meta;
use Mapper;

class MapsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //$projects = Project::paginate(10);
        $programas = Programa::all();
        $departamentos = Departamento::all();
        $estados = Estado::all();
        $projects = Project::query();
        $metas = Meta::all();
        $administracion = Administracion::all();

        if ($request->input('progid')) {
            $projects = $projects->where('SEOBProgr', $request->input('progid'));
        }

        if ($request->input('dptoid')) {
            $projects = $projects->where('DptoId', $request->input('dptoid'));
        }

        if ($request->input('estadoid')) {
            $projects = $projects->where('SEOBEst', $request->input('estadoid'));
        }

        if ($request->input('expnro')) {
            $projects = $projects->where('SEOBNroExp', $request->input('expnro'));
        }

        if ($request->input('proyname')) {
            $searchTerm = $request->input('proyname');
            $projects = $projects->where('SEOBProy', 'LIKE', "%{$searchTerm}%"); 
        }

        if ($request->input('satname')) {
            $searchTermsat = $request->input('satname');
            $projects = $projects->where('SEOBEmpr', 'LIKE', "%{$searchTermsat}%"); 
        }

        if ($request->input('adminid')) {

            $projects = $projects->where('SEOBAdmin', $request->input('adminid'));

        }

        if ($request->input('metaid')) {

            $projects = $projects->where('SEOBPlan', $request->input('metaid'));

        }

        if ($request->input('porcentajeid')) {

            if ($request->input('porcentajeid') == 1 ){
                $projects = $projects->where('SEOBFisAva','<=', 25);
            }

            if ($request->input('porcentajeid') == 2 ){
                $projects = $projects->where('SEOBFisAva','>=', 26);
                $projects = $projects->where('SEOBFisAva','<=', 50);
            }

            if ($request->input('porcentajeid') == 3 ){
                $projects = $projects->where('SEOBFisAva','>=', 51);
                $projects = $projects->where('SEOBFisAva','<=', 75);
            }

            if ($request->input('porcentajeid') == 4 ){
                $projects = $projects->where('SEOBFisAva','>=', 76);
            }
            

        }

        

        $projects = $projects->paginate(5000);
        $progid=$request->input('progid');
        $dptoid=$request->input('dptoid');
        $estadoid=$request->input('estadoid');
        $page=$request->input('page');
        $expnro=$request->input('expnro'); 
        $proyname=$request->input('proyname');
        $satname=$request->input('satname');
        $adminid=$request->input('adminid');
        $metaid=$request->input('metaid');
        $porcentajeid=$request->input('porcentajeid');


        $map = Mapper::map(-25.3006592, -57.63591,['marker' => false]);


        foreach ($projects as $key => $project) {
            try {
                
                $depto=$project->DptoId?$project->departamento->DptoNom:"";
                $distrito=$project->CiuId?$project->distrito->CiuNom:"";
                $avance =number_format($project->SEOBFisAva,0,'.','.');
                $contentString = '<div id="content">'.
                '<div id="siteNotice">'.
                '</div>'.
                '<h4 id="firstHeading" >'.utf8_encode($project->SEOBProy).'</h4>'.
                '<div id="bodyContent">'.
                '<p><b>SAT:</b> '.utf8_encode($project->SEOBEmpr).'<br>'.
                '<b>Departamento:</b> '.utf8_encode($depto).'<br>'.
                '<b>Distrito:</b> '.utf8_encode($distrito).'<br>'.
                '<b>Estado:</b> '.$project->SEOBEst.'<br>'.
                '<b>Total Casas:</b> '.$project->SEOBViv.'<br>'.
                '<b>Total Avance:</b> '.$avance.'%<br></p>'.
                '<div class="progress-bar bg-success" style="width: '.$project->SEOBFisAva.'% "></div>'.
                '<p>Resumen del Proyecto:'.'<a href="/home/'.$project->SEOBId.'">'.utf8_encode($project->SEOBProy).'</a>'.
                '</p>'.
                '</div>'.
                '</div>';
                $latlong= $this->ToLL((int)$project->SEOBUtmY,(int)$project->SEOBUtmX,preg_replace("/[^0-9]/", '', $project->SEOBUtm1));
                //$map = Mapper::map($latlong['lat'], $latlong['lon']);
                //$map =  Mapper::marker($latlong['lat'], $latlong['lon'], ['draggable' => true, 'eventMouseOver' => 'console.log("mouse over");']);
                $map =  Mapper::informationWindow($latlong['lat'], $latlong['lon'], $contentString, ['open' => false, 'maxWidth'=> 300, 'markers' => ['title' => $project->SEOBEmpr]]);
            } catch (\Throwable $th) {
                $map =  Mapper::marker(0, 0);
            }
            
        }

        //->marker(-23.442503, -58.4438324);

        return view('mapas.index',compact('projects','metas','programas','progid','departamentos','dptoid','estados','estadoid',
        'page','expnro','map','proyname','satname','administracion','adminid','metaid','porcentajeid'));
        //
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

    public function ToLL($north, $east, $utmZone)
    {
      // This is the lambda knot value in the reference
      $LngOrigin = Deg2Rad($utmZone * 6 - 183);

      // The following set of class constants define characteristics of the
      // ellipsoid, as defined my the WGS84 datum.  These values need to be
      // changed if a different dataum is used.

      $FalseNorth = 10000000;   // South or North?
      //if (lat < 0.) FalseNorth = 10000000.  // South or North?
      //else          FalseNorth = 0.

      $Ecc = 0.081819190842622;       // Eccentricity
      $EccSq = $Ecc * $Ecc;
      $Ecc2Sq = $EccSq / (1. - $EccSq);
      $Ecc2 = sqrt($Ecc2Sq);      // Secondary eccentricity
      $E1 = ( 1 - sqrt(1-$EccSq) ) / ( 1 + sqrt(1-$EccSq) );
      $E12 = $E1 * $E1;
      $E13 = $E12 * $E1;
      $E14 = $E13 * $E1;

      $SemiMajor = 6378137.0;         // Ellipsoidal semi-major axis (Meters)
      $FalseEast = 500000.0;          // UTM East bias (Meters)
      $ScaleFactor = 0.9996;          // Scale at natural origin

      // Calculate the Cassini projection parameters

      $M1 = ($north - $FalseNorth) / $ScaleFactor;
      $Mu1 = $M1 / ( $SemiMajor * (1 - $EccSq/4.0 - 3.0*$EccSq*$EccSq/64.0 - 5.0*$EccSq*$EccSq*$EccSq/256.0) );

      $Phi1 = $Mu1 + (3.0*$E1/2.0 - 27.0*$E13/32.0) * sin(2.0*$Mu1);
        + (21.0*$E12/16.0 - 55.0*$E14/32.0)           * sin(4.0*$Mu1);
        + (151.0*$E13/96.0)                          * sin(6.0*$Mu1);
        + (1097.0*$E14/512.0)                        * sin(8.0*$Mu1);

      $sin2phi1 = sin($Phi1) * sin($Phi1);
      $Rho1 = ($SemiMajor * (1.0-$EccSq) ) / pow(1.0-$EccSq*$sin2phi1,1.5);
      $Nu1 = $SemiMajor / sqrt(1.0-$EccSq*$sin2phi1);

      // Compute parameters as defined in the POSC specification.  T, C and D

      $T1 = tan($Phi1) * tan($Phi1);
      $T12 = $T1 * $T1;
      $C1 = $Ecc2Sq * cos($Phi1) * cos($Phi1);
      $C12 = $C1 * $C1;
      $D  = ($east - $FalseEast) / ($ScaleFactor * $Nu1);
      $D2 = $D * $D;
      $D3 = $D2 * $D;
      $D4 = $D3 * $D;
      $D5 = $D4 * $D;
      $D6 = $D5 * $D;

      // Compute the Latitude and Longitude and convert to degrees
      $lat = $Phi1 - $Nu1*tan($Phi1)/$Rho1 * ( $D2/2.0 - (5.0 + 3.0*$T1 + 10.0*$C1 - 4.0*$C12 - 9.0*$Ecc2Sq)*$D4/24.0 + (61.0 + 90.0*$T1 + 298.0*$C1 + 45.0*$T12 - 252.0*$Ecc2Sq - 3.0*$C12)*$D6/720.0 );

      $lat = Rad2Deg($lat);

      $lon = $LngOrigin + ($D - (1.0 + 2.0*$T1 + $C1)*$D3/6.0 + (5.0 - 2.0*$C1 + 28.0*$T1 - 3.0*$C12 + 8.0*$Ecc2Sq + 24.0*$T12)*$D5/120.0) / cos($Phi1);

      $lon = Rad2Deg($lon);

      // Create a object to store the calculated Latitude and Longitude values
      $PC_LatLon['lat'] = $lat;
      $PC_LatLon['lon'] = $lon;

      // Returns a PC_LatLon object
      return $PC_LatLon;
      //return "['latitude' => ".$lat.", 'longitude' => ".$lon."], ";
    }
}
