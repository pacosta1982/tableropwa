        <!-- The timeline -->
        <ul class="timeline timeline-inverse">
          <!-- timeline time label -->

          @foreach($historial as $his)

          <li class="time-label">
            <span class="bg-danger">
                    {{ date('d/m/Y', strtotime($his->DEFecDis))}}
            </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-envelope bg-primary"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{$his->DENroLin}}</span>

              <h3 class="timeline-header"><a href="#">{!! $his->DEUnOrHa?$his->deporigen->DepenDes:"" !!}</a> este evento fue generado por: <b>{{$his->DERcpNam}}</b></h3>

              <div class="timeline-body">
                  <p><b>Dependecia Destino: </b> {!! $his->DEUnOrHa?$his->depdestino->DepenDes:"" !!}</p>                  
                  <p><b>Observaciones: </b>{{$his->DEExpAcc}}</p>
              </div>
              <div class="timeline-footer">
                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                <a href="#" class="btn btn-danger btn-sm">Delete</a>
              </div>
            </div>
          </li>

          @endforeach
          <!-- END timeline item -->
          <!-- timeline item -->
          
          <!-- END timeline item -->
          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>
