@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
<section class="content-header">
  <h1>
    Empleado 
  </h1>
</section>

<section class="content">
      <div class="row">
        <div class="col-md-3" data-bind="with: model.empleadoInfoController.empleado">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" data-bind="attr:{src: (avatar() !== null && avatar() !== '' ? '/img/'+avatar() : emptyLogo)}" alt="User profile picture">

              <h3 class="profile-username text-center" data-bind="text: nombre_completo"></h3>

              <p class="text-muted text-center" data-bind="text: cargo"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Departamento</b> <a class="pull-right" data-bind="text: departamento"></a>
                </li>
                <li class="list-group-item">
                  <b>CUI</b> <a class="pull-right" data-bind="text: dpi"></a>
                </li>
                <li class="list-group-item">
                  <b>NIT</b> <a class="pull-right" data-bind="text: nit"></a>
                </li>
                <li class="list-group-item">
                  <b>Edad</b> <a class="pull-right" data-bind="text: edad()+' años'"></a>
                </li>
                <!-- ko if: estado() == '1' -->
                <li class="list-group-item">
                  <b>Estado</b> <span class="pull-right label label-success"> Activo</span>
                </li>
                <!-- /ko -->

                <!-- ko if: estado() == '0' -->
                <li class="list-group-item">
                  <b>Estado</b> <span class="pull-right label label-danger"> Inactivo</span>
                </li>
                <!-- /ko -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mas información</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted" data-bind="text: profesion">
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion</strong>

              <p class="text-muted" data-bind="text: direccion"></p>
              <hr>
              <strong><i class="fa fa-envelope margin-r-5"></i> Correo electronico</strong>

              <p class="text-muted" data-bind="text: email"></p>

              <hr>
              <strong><i class="fa fa-phone"></i> Telefonos</strong>
            <!-- ko foreach: {data: telefonos, as: 't'} -->
              <p class="text-muted" data-bind="text: '.-  '+t.telefono"></p>
              <!-- /ko -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#historial" data-toggle="tab" aria-expanded="true">Historial laboral</a></li>
              <li data-bind="visible: model.empleadoInfoController.showUser()" class=""><a href="#cambio" data-toggle="tab" aria-expanded="false">Cambiar contraseña</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="historial">
                <div class="row text-center">
                  <a class="btn btn-warning btn-xs"> inicio contrato</a>
                  <a class="btn btn-success btn-xs"> fin contrato activo</a>
                  <a class="btn btn-danger btn-xs"> fin contrato vencido / anulado</a>
                </div><hr />
                <ul class="timeline timeline-inverse">

              <!-- ko if: model.empleadoInfoController.contratos().length === 0 -->
                <div class="alert alert-info text-center"> ningun contrato encontrado</div>
                <!-- /ko -->
                <!-- ko foreach: {data: model.empleadoInfoController.contratos, as: 'c'} -->
                  <li class="time-label">
                        <span class="bg-yellow" data-bind="text: (moment(c.fecha_inicio)).format('dddd, DD MMMM YYYY')"></span>

                        <!-- ko if: c.vencido == '1' -->
                        <span class="bg-red" data-bind="text: (moment(c.fecha_fin)).format('dddd, DD MMMM YYYY')"></span>
                        <!-- /ko -->

                        <!-- ko if:c.vencido == '0' && c.deleted_at == null -->
                        <span class="bg-green" data-bind="text: (moment(c.fecha_fin)).format('dddd, DD MMMM YYYY')"></span>
                        <!-- /ko -->

                        <!-- ko if:c.deleted_at != null -->
                        <span class="bg-red" data-bind="text: (moment(c.deleted_at)).format('dddd, DD MMMM YYYY')"></span>
                        <!-- /ko -->
                  </li>
                  <li>
                    <i class="fa fa-file bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-status"></i> 
                        <!-- ko if:c.vencido == '0' && c.deleted_at === null -->
                        <a class="btn btn-success btn-xs">Contrato activo</a>
                        <!-- /ko -->

                        <!-- ko if: c.deleted_at !== null -->
                        <a class="btn btn-danger btn-xs">Contrato anulado</a>
                        <!-- /ko -->

                        <!-- ko if:c.vencido == '1' -->
                        <a class="btn btn-danger btn-xs">Contrato vencido</a>
                        <!-- /ko --></span>
                      <h3 class="timeline-header"><a data-bind="text: 'contrato no. '+ c.no_contrato"></a></h3>

                      <div class="timeline-body">
                        <h5 class="timeline-header no-border"><label>Tipo contrato: </label> <span data-bind="text: c.tipo_contrato.numero + ',  '+c.tipo_contrato.nombre"></span>
                        </h5>
                        <h5 class="timeline-header no-border"><label>Monto total del contrato: </label> <span data-bind="text: formatCurrency(parseFloat(monto).toFixed(2))"></span>
                        </h5>
                        <h5 class="timeline-header no-border"><label>Departamento: </label> <span data-bind="text: c.unidad_cargo.unidad.nombre"></span>
                        </h5>
                        <h5 class="timeline-header no-border"><label>Puesto laboral: </label> <span data-bind="text: c.unidad_cargo.cargo.nombre"></span>
                        </h5>
                      </div>
                      <div class="timeline-footer">
                      </div>
                    </div>
                  </li>
                  <!-- /ko -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="cambio">
                <div class="content">
                  
                <form name="changeForm" id="changeForm" data-bind="with: model.empleadoInfoController.usuario">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="text2">Contraseña anterior <span class="text-danger"> *</span></label>
                        <input type="password" id="old_password" name="old_password" placeholder="ingrese contraseña anterior" class="form-control"data-bind="value: old_password"
                             data-error=".errorOldPass"
                             minlength="6" maxlength="25" required>
                      <span class="text-danger errorOldPass help-inline"></span>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="text2">Nueva contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password" name="password" placeholder="ingrese contraseña" class="form-control"data-bind="value: password"
                                     data-error=".errorPassword"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorPassword help-inline"></span>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="text2">Confirmar contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="confirmar contraseña" class="form-control"data-bind="value: password_confirmation"
                                     data-error=".errorConfirmation"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorConfirmation help-inline"></span>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.empleadoInfoController.cambiar"><i class="fa fa-save"></i> Cambiar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.empleadoInfoController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
                          </div>
                </form>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
          var url_string = window.location.href
          var url = new URL(url_string);
          var id = url.searchParams.get("id");
          model.empleadoInfoController.userLogged({{Auth::user()->id}});

          model.empleadoInfoController.initialize(id);

        });
</script>
@endsection