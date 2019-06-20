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
        @php
            $now = new DateTime($his->DEFecDis)
        @endphp 
        <tr>
        <td style="text-align:center;">{{$date->diff($now)->format("%a")}}</td>
        <td style="text-align:center;">{{$his->DENroLin}}</td>
        <td style="text-align:center;">{{ date('d/m/Y', strtotime($his->DEFecDis))}}</td>
        <td>{!! $his->DEUnOrHa?$his->deporigen->DepenDes:"" !!}</td>
        <td>{!! $his->DEUnOrHa?$his->depdestino->DepenDes:"" !!}</td>
        <td>{{$his->DEExpEst}}</td>
        <td style="text-align:center;">
            @if ($his->DEExpEst != 'P') 
              {{ date('d/m/Y', strtotime($his->DEFecRcp))}}
          
          @endif
          </td>
        <td style="text-align:center;">{{$his->DERcpNam}}</td>
        <td>{{$his->DEExpAcc}}</td>
        </tr>
        @php
            $date = new DateTime($his->DEFecDis)
        @endphp
        @endforeach
        @php
            $date = new DateTime($historial->first()->DEFecDis);
            $now = new DateTime();
        @endphp 
        <tr>
          <td style="text-align:center;">{{$date->diff($now)->format("%a")}}</td>
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