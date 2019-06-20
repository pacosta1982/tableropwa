<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">Dashboard</span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Gravatar::get($user->email) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{url('/home')}}" class="nav-link">
                <i class="nav-icon fa fa-th-list"></i>
                <p>
                  Inicio
                </p>
              </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/mapas')}}" class="nav-link">
                      <i class="nav-icon fa fas fa-globe"></i>
                      <p>Mapa de Proyectos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/viviendas')}}" class="nav-link">
                      <i class="nav-icon fa fas fa-home"></i>
                      <p>Mapa de Viviendas</p>
                    </a>
                  </li>
                <li class="nav-item">
                  <a href="{{url('/graficos')}}" class="nav-link ">
                    <i class="nav-icon fa fa-bar-chart"></i>
                    <p>Graficos</p>
                  </a>
                </li>
                <div class="brand-link"></div>
                <li class="nav-item">
                    <a href="{{url('/logout')}}" class="nav-link">
                      <i class="nav-icon fa fa-fw fa-power-off"></i>
                      <p>Salir</p>
                    </a>
                  </li>
                               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        
    </div>
    <!-- /.sidebar -->
</aside>