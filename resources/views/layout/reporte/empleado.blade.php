<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    <title>Listado de Empleados</title>
    <style>
      #contenido {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #000;
      }
      th {
        font-size: 12px;
        text-align: center;
        vertical-align: center;
        border-collapse: collapse;
        padding: 0.3em;
      }
      td {
        vertical-align: center;
        align-content: center;
        font-size: 10px;
        border-top: 1px solid #000;
        padding: 0.3em;
        border-collapse: collapse;
        white-space:initial;
      }      
      caption {
        padding: 0.3em;
        color: #fff;
          background: #000;
      }
      th {
        background: #eee;
      }  
      head {
        text-align: center;
        align-content: center;
        align-items: center;
      }
      #titulo {
        text-align: center;
        font-size: 24px;
      }
      #subtitulo {
        text-align: center;
        font-size: 18px;
      }    
      footer {
        text-align: right;
        font-size: 10px;
      }  
    </style>
</head>
<body id="contenido">
  <head>
    <div id="titulo">
      REPORTE DE EMPLEADOS REGISTRADOS
    </div>
    <div id="subtitulo">
      FECHA DEL REPORTE {{ date('d/m/Y') }}
    </div>    
  </head>
  <br><br>
  <div>
    <table>
      <thead>
        <tr>
          <th>Correlativo</th>
          <th>DPI</th>
          <th>Empleado</th>
          <th>NIT</th>
          <th>Dirección</th>
          <th>Información</th>
          <th>Telefonos</th>
        </tr>
      </thead>
      <tbody>
        @foreach($empleados_informacion as $data)
        <tr>
          <td style="text-align: center;">{{ $data['correlativo'] }}</td>
          <td style="text-align: center;">{{ $data['dpi'] }}</td>
          <td style="text-align: left;">{{ $data['empleado'] }}</td>
          <td style="text-align: center;">{{ $data['nit'] }}</td>
          <td style="text-align: left;">{{ $data['direccion'] }}</td>
          <td>
            <ul>
              <li>Nacimiento: {{ $data['nacimiento'] }}</li>
              <li>Correo: {{ $data['email'] }}</li>
              <li>Sexo: {{ $data['genero'] }}</li>
              <li>Estado Civil: {{ $data['estado_civil'] }}</li>
              <li>Profesión: {{ $data['profesion'] }}</li>
            </ul>        
          </td>
          <td>
            <ul>
              @foreach($data['telefonos'] as $tel)
                <li>{{ $tel['numero'] }}</li>
              @endforeach
              @if(count($data['telefonos']) == 0)
                <li>N/A</li>
              @endif
            </ul>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <footer>
    <strong>{{ $usuario->nombre1.' '.$usuario->apellido1 }}</strong>
  </footer>
</body>
</html>