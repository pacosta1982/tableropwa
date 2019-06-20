<table class="table table-striped">
        <tbody>
        <tr>
          <th>Observacion</th>
          <th>Expediente</th>
          <th style="text-align:center;">Fecha</th>
          <th style="text-align:center;">Usuario</th>
        </tr>
        @foreach($observacionesfonavis as $obs) 
        <tr>
        <td>{{$obs->SPDetConc}}</td>
        <td style="text-align:center;">
          @if($obs->SPDetNrExp != 0)
        
          <a href="{!! action('HomeController@showexp', ['id'=>$project->SEOBId,'NroExpS'=>'A','idexp'=>$obs->SPDetNrExp,'progid' => $progid
              ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1']) !!}">{{(substr($obs->SPDetNrExp,0,-2)).'-'.(substr($obs->SPDetNrExp,-2))}}</a>

        @else 
        {{$obs->SPDetNrExp}}
        @endif
        </td>
        <td style="text-align:center;">{{ date('d/m/Y', strtotime($obs->SPDetFec))}}</td>
        <td style="text-align:center;">{{$obs->SPDetUsu}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>