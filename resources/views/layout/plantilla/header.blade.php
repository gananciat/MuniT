  
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SIAC</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIAC</b>ontratos</span> 
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @if(isset(Auth::user()->empleado->avatar))
                  <img src="{{URL::asset('img/'.Auth::user()->empleado->avatar)}}" class="user-image" alt="User Image">
                  @endif
                  <span class="hidden-xs"> {{Auth::user()->empleado->nombre1}} {{Auth::user()->empleado->apellido1}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    @if(isset(Auth::user()->empleado->avatar))
                    <img src="{{URL::asset('img/'.Auth::user()->empleado->avatar)}}" class="img-circle" alt="User Image">
                    @endif
                    <p>
                      muni guazacapan
                      <small>www.muniguazacapan.com</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                    <div class="pull-left">
                      <a href="{{ route('perfil', ['id'=>Auth::user()->empleado_id]) }}" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> Perfil</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>