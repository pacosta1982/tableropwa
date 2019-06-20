<table class="table table-striped">
        <tbody>
        <tr>
          <th style="text-align:center;">Días</th>
          <th style="text-align:center;">Linea</th>
          <th style="text-align:center;">Fecha</th>
          <th >Dependencia Origen</th>
          <th >Dependencia Destino</th>
          <th>Estado</th>
          <th>Fecha Recepción</th>
          <th style="text-align:center;">Recepcionado por</th>
          <th>Observacion</th>
        </tr>
        @php
            //$ini = $historial->first()->DEFecDis;
            $date = new DateTime($historial->first()->DEFecDis);
            //$now = new DateTime();

            //echo $date->diff($now)->format("%d days, %h hours and %i minuts");
        @endphp
        
        @foreach($historial as $his)

        <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td></td>
        </tr>
        @endforeach
        <tr>
          <td style="text-align:center;"></td>
          <td style="text-align:center;">Total Dias</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>