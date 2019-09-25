<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">       
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header"></li>
        <li id="mEscritorio">
        <a href="/">
          <i class="fa fa-tasks"></i> <span>Escritorio</span>
        </a>
      </li>

      <li id="mAlmacen" class="treeview">
        <a href="#">
          <i class="fa fa-cog"></i>
          <span>Configuración</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="ideptos"><a href="{{ route('departamentosView') }}"><i class="fa fa-circle-o"></i> Departamentos</a></li>
          <li id="lmunicipio"><a href="{{ route('municipiosView') }}"><i class="fa fa-circle-o"></i> Municipios</a></li>
          <li id="lTipoDocumento"><a href="{{ route('tipoDocumentosView') }}"><i class="fa fa-circle-o"></i> Tipo Documentos</a></li>
          <li id="lDias"><a href="{{ route('diasView') }}"><i class="fa fa-circle-o"></i> Dias Laborales</a></li>
          <li id="lPrestaciones"><a href="{{ route('prestacionssView') }}"><i class="fa fa-circle-o"></i> Prestaciones</a></li>
          <li id="lTipoContrato"><a href="{{ route('tipoContratosView') }}"><i class="fa fa-circle-o"></i> Tipo Contratos</a></li>
          <li id="lEstadoCivil"><a href="{{ route('estadoCivilsView') }}"><i class="fa fa-circle-o"></i> Estados Civiles</a></li>
        </ul>
      </li>

      <li id="mCompras" class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Recursos Humanos</span>
           <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="cargos"><a href="{{ route('cargosView') }}"><i class="fa fa-circle-o"></i> Puestos Laborales</a></li>
          <li id="departamentos"><a href="{{ route('unidadsView') }}"><i class="fa fa-circle-o"></i>Unidad Departamentos</a></li>
          <li id="empleado"><a href="{{ route('empleadosView') }}"><i class="fa fa-circle-o"></i> Empleados</a></li>
          <li id="lcontratt¿os"><a href="{{ route('contratosView') }}"><i class="fa fa-circle-o"></i> Contratos</a></li>
        </ul>
      </li>
      
      <li id="mAcceso" class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Acceso</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="lUsuarios"><a href="{{ route('usersView') }}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
          <li id="ltipoUsuario"><a href="{{ route('tipoUsuariosView') }}"><i class="fa fa-circle-o"></i> Tipo Usuarios</a></li>
          
        </ul>
      </li>

      <li>
        <a href="#">
          <i class="fa fa-plus-square"></i> <span>Ayuda</span>
          <small class="label pull-right bg-red">PDF</small>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
          <small class="label pull-right bg-yellow">SIAC</small>
        </a>
      </li>
                  
    </ul>
  </section>
        <!-- /.sidebar -->
      </aside>