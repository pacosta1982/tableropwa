<table class="table table-striped">
        <tbody>
        <tr>
          <th>Observacion</th>
          <th style="text-align:center;">Fecha</th>
          <th style="text-align:center;">Usuario</th>
        </tr>
        @foreach($observaciones as $obs) 
        <tr>
        <td>{{$obs->SEOBObserv}}</td>
        <td style="text-align:center;">{{ date('d/m/Y', strtotime($obs->SEOBFecObs))}}</td>
        <td style="text-align:center;">{{$obs->SEOBUsuCod}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>