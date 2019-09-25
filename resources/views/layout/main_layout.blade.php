<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layout.plantilla.head')
   @include('layout.plantilla.scripts')
 </head>

  <body class="hold-transition skin-blue-light sidebar-mini">
	@include('layout.plantilla.header')
	@include('layout.plantilla.sidebar')
	@yield('content')
 	@include('layout.plantilla.footer')
 	@yield('js')
 </body>
</html>

<style type="text/css">
	.error {
  color: #F00;
  background-color: #FFF;
}
</style>