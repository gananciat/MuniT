<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>

<!-- DATATABLES -->
<script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>    
<script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('datatables/buttons.colVis.min.js')}}"></script>
<script src="{{asset('datatables/jszip.min.js')}}"></script>
<script src="{{asset('datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('datatables/vfs_fonts.js')}}"></script> 

<script src="{{asset('js/bootbox.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!--  -->
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.validate.localization.js') }}"></script>
<script src="{{ asset('js/knockout-3.4.2.js')}}"></script>
<script src="{{asset('js/knockout.mapping.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script> 
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>

<!-- scripts  -->
<script src="{{asset('jsfiles/js/model.js')}}"></script>
<script src="{{asset('jsfiles/js/departamento.js')}}"></script>
<script src="{{asset('jsfiles/js/municipio.js')}}"></script>
<script src="{{asset('jsfiles/js/dia.js')}}"></script>
<script src="{{asset('jsfiles/js/tipoDocumento.js')}}"></script>
<script src="{{asset('jsfiles/js/estadoCivil.js')}}"></script>
<script src="{{asset('jsfiles/js/prestacion.js')}}"></script>
<script src="{{asset('jsfiles/js/tipoContrato.js')}}"></script>
<script src="{{asset('jsfiles/js/cargo.js')}}"></script>
<script src="{{asset('jsfiles/js/unidad.js')}}"></script>
<script src="{{asset('jsfiles/js/unidadCargo.js')}}"></script>
<script src="{{asset('jsfiles/js/empleado.js')}}"></script>
<script src="{{asset('jsfiles/js/contrato.js')}}"></script>
<script src="{{asset('jsfiles/js/documentoContrato.js')}}"></script>
<script src="{{asset('jsfiles/js/tipoUsuario.js')}}"></script>
<script src="{{asset('jsfiles/js/user.js')}}"></script>
<script src="{{asset('jsfiles/js/empleadoInfo.js')}}"></script>

<!-- scripts  axios-->
<script src="{{asset('jsfiles/services/departamentoService.js')}}"></script>
<script src="{{asset('jsfiles/services/municipioService.js')}}"></script>
<script src="{{asset('jsfiles/services/diaService.js')}}"></script>
<script src="{{asset('jsfiles/services/tipoDocumentoService.js')}}"></script>
<script src="{{asset('jsfiles/services/estadoCivilService.js')}}"></script>
<script src="{{asset('jsfiles/services/prestacionService.js')}}"></script>
<script src="{{asset('jsfiles/services/tipoContratoService.js')}}"></script>
<script src="{{asset('jsfiles/services/cargoService.js')}}"></script>
<script src="{{asset('jsfiles/services/unidadService.js')}}"></script>
<script src="{{asset('jsfiles/services/unidadCargoService.js')}}"></script>
<script src="{{asset('jsfiles/services/empleadoService.js')}}"></script>
<script src="{{asset('jsfiles/services/contratoService.js')}}"></script>
<script src="{{asset('jsfiles/services/documentoContratoService.js')}}"></script>
<script src="{{asset('jsfiles/services/tipoUsuarioService.js')}}"></script>
<script src="{{asset('jsfiles/services/userService.js')}}"></script>

<script>
	$(document).ready(function () {
	    ko.applyBindings();

	    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>