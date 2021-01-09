@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:50px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item active">Administración de Tareas</li>
  </ol>
</div>
 <!-- End Navbar -->

      <div class="container">

          <div class="row">
           <div class="col-md-6">
            </div>
            <div class="col-md-3">
              <!--<a style="color:white;" class="btn btn-round btn-sucess"  href="/admiUsuariosInhabilitados">Usuarios Inhabilitados</a>-->
            </div>
            <div class="col-md-3">
              <a style="color:white;" class="btn btn-round btn-primary" data-toggle="modal" data-target="#insertUser">Crear Tarea</a>
            </div>
          <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Administración de Tareas</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Titulo</th>
                      <th>Materia</th>
                      <th>Fecha Entrega</th>
                      <th class="disabled-sorting ">Acciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                  
                  <th>Titulo</th>
                      <th>Materia</th>
                      <th>Fecha Entrega</th>

                      <th class="disabled-sorting">Acciones</th>

                  </tfoot>
                  <tbody>
                  @foreach($tareas as $tarea)
                    <tr>
                      <td>{{$tarea->TituloTarea}}</td>
                      <td>{{$tarea->NombreCurso}}</td>
                     
                      <td>
                        @php
                            $date = Date::parse($tarea->Fecha);
                            echo $date->format('l d F Y');
                        @endphp
                      </td>

                      <td class="text-center">
                        <a class="btn btn-round btn-warning btn-icon btn-sm" href="/vistaActualizarTarea/{{$tarea->idTarea}}" ><i class="fas fa-edit"></i></a>
                        <abbr title="Detalle de Tarea">
                          <a class="btn btn-round btn-primary btn-icon btn-sm" href="/detallesTarea/{{$tarea->idTarea}}">
                              <i class="fas fa-eye">
                              </i>
                          </a>    
                        </abbr>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>

<!--MODAL-->

<div class="modal fade" id="insertUser" tabindex="-1" role="dialog" aria-labelledby="validarCodigo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="/crearTarea">
            {{csrf_field()}}
            <div class="form-group" style="margin-bottom:45px;">
                <label for="email">Curso:</label>
                <select class="form-control" required="" name="curso" style="margin-top:25px;">
                        <option value="">Seleccionar...</option>
                        @foreach($cursos as $curso)
                        <option value="{{$curso->idDetalleCurso}}">{{$curso->NombreCurso}}</option>
                        @endforeach
                </select>
                @if($errors->has('name'))
                <span class="help-block text-danger">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Titulo de la Tarea:</label>
                <input type="text" required="" value="{{old('name')}}" name="name" class="form-control">
                @if($errors->has('name'))
                <span class="help-block text-danger">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
            
            <div class="form-group row">
            <label for="email">Descripcion:</label>
                
               
              <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" type="text" name="descripcion" value="{{ old('descripcion') }}">{{old('descripcion')}}</textarea>
             
              
              @error('descripcion')
              <span class="invalid-feedback" role="alert" style="margin-top:50px;">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror 
               
            </div>

            <div class="form-group">
                <label for="email">Fecha:</label>
                <input class="form-control"  value="{{old('fecha')}}" type="date" id="start" name="fecha"  min="1900-01-01" max="2100-12-31">
                @if($errors->has('fecha'))
                <span class="help-block text-danger">
                El campo fecha debe ser una fecha posterior o igual al día de hoy.
                </span>
                @endif
            </div>  

            <div class="form-group" style="margin-bottom:40px;">
                <label class="bmd-label-floating">Hora:</label>
                <select class="form-control" required="" name="hora" style="margin-top:25px;">
                        <option value="">Seleccionar...</option>
                        @foreach($horas as $hora)
                        <option value="{{$hora}}">{{$hora}}</option>
                        @endforeach
                </select>
            </div>


            <br>
            <div class="row justify-content-center">
            <button type="submit"  style="margin-bottom:30px; margin-top:30px;width:200px;"  class="btn btn-round btn-primary" style="background-color:greeen !important;">Insertar</button>
            <button type="button" style="margin-bottom:30px; margin-top:30px;width:200px;" class="btn btn-round btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>


 @endsection

@section('scripts')
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "",
          searchPlaceholder: "Escribe Tu Busqueda",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
@endsection
