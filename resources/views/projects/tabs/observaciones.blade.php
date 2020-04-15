<table class="table table-striped">
        <tbody>
        <tr>
          <th>Observacion</th>
          <th>Expediente</th>
          <th style="text-align:center;">Fecha</th>
          <th style="text-align:center;">Usuario</th>
        </tr>
        @foreach($observaciones as $obs)
        <tr>
        <td>{{$obs->SEOBObserv}}</td>
        <td>{{$obs->SEOBDExpNro}}</td>
        <td style="text-align:center;">
            @if($obs->SEOBDExpNro != 0)

            <a href="{!! action('HomeController@showexp', ['id'=>$project->SEOBId,'NroExpS'=>'A','idexp'=>$obs->SEOBDExpNro,'progid' => $progid
                ,'dptoid' => $dptoid,'estadoid' => $estadoid,'page' => $page,'idtipo'=>'1']) !!}">{{(substr($obs->SEOBDExpNro,0,-2)).'-'.(substr($obs->SEOBDExpNro,-2))}}</a>

          @else
          {{$obs->SEOBDExpNro}}
          @endif
          </td>
        <td style="text-align:center;">{{ date('d/m/Y', strtotime($obs->SEOBFecObs))}}</td>
        <td style="text-align:center;">{{$obs->SEOBUsuCod}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
