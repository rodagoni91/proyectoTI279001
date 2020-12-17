@extends('layouts.admin')
@section('contenido')
<div class="container" style="margin-top:50px;">
    <ol class="breadcrumb" style="z-index: 999;margin-top:60px;">
        <li class="breadcrumb-item"><a href="/home">Panel</a></li>
        <li class="breadcrumb-item"><a href="/admiTareas">Mis Tareas</a></li>
        <li class="breadcrumb-item active">Detalles de {{$tarea->TituloTarea}}</li>  
    </ol>
</div>
<!-- End Navbar -->
<div class="container">
    <div class="row ">
        <div class="col-md-6">
        </div>
        <div class="col-md-3">
            <!--<a style="color:white;" class="btn btn-round btn-sucess"  href="/admiUsuariosInhabilitados">Usuarios Inhabilitados</a>-->
        </div>
        <div class="col-md-3">
            
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Detalles de <strong>{{$tarea->TituloTarea}}</strong><br></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>
                                <strong>Nombre del Curso:</strong> {{$curso->NombreCurso}}<br>
                                <strong>Dias:</strong> {{$curso->Dias}}<br>
                            </h4>
                        </div>
                        <div class="col-sm-4 col-md-4"></div>
                       
                    </div>

                    <div class="row">
                        <div class="col-sm-10 col-md-10">
                            <h4>
                                <strong>Titulo de la Tarea:</strong> {{$tarea->TituloTarea}}<br>
                                <strong>Descripcion:</strong> {{$tarea->DescripcionTarea}}<br>
                                <strong>Fecha de Entrega Limite:</strong>  @php
                                    $date = Date::parse($tarea->Fecha);
                                    echo $date->format('l d F Y');
                                @endphp<br> 
                               
                            </h4>
                        </div>
                        
                       
                    </div>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nombre del Alumno</th>
                      <th>Archivo de Tarea</th>
                      <th>Fecha de Entrega</th>
                      <th>Estatus</th>
                      <th class="disabled-sorting ">Acciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <th>Nombre del Alumno</th>
                    <th>Archivo de Tarea</th>
                    <th>Fecha de Entrega</th>
                    <th>Estatus</th>
                    <th class="disabled-sorting ">Acciones</th>

                  </tfoot>
                  <tbody>
                  @foreach($entregas as $entrega)
                    <tr>
                        <td>{{$entrega->NombreAlumno}}</td>
                        <td><a href="{{$entrega->ArchivoTarea}}" target="_blank">Decargar Tarea</a></td>
                        <td>
                            @php
                                $date = Date::parse($entrega->created_at);
                                echo $date->format('l d F Y');
                            @endphp
                        </td>

                        <td>
                            @if($entrega->Calificacion == "Sin Calificacion")
                            Sin Calificar
                            @endif
                            @if($entrega->Calificacion != "Sin Calificacion")
                            Calificada
                            @endif
                        </td>

                        <td class="text-center">
                            <!--<a class="btn btn-round btn-warning btn-icon btn-sm" href="/actualizarEscuela/{{$escuela->idEscuela}}" ><i class="fas fa-edit"></i></a>-->
                            @if($entrega->Calificacion == "Sin Calificacion")
                            <a href="#" class="btn btn-round btn-success btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal{{$escuela->idEscuela}}"><i class="fas fa-edit"></i></a>
                            <div class="modal fade" id="exampleModal{{$escuela->idEscuela}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$escuela->idEscuela}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{$escuela->idEscuela}}">Calificar Tarea</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/calificarTarea" method="post" >
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <input type="hidden" name="idEntrega" value="{{$entrega->idEntrega}}">
                                                <div class="form-group">
                                                    <label for="email">Calificacion:</label>
                                                    <input type="number" required="" value="{{old('Calificacion')}}" name="Calificacion" class="form-control" min="0" max="10">
                                                    @if($errors->has('Calificacion'))
                                                    <span class="help-block text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                    @endif
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="email">Comentarios:</label>
                                                    <textarea class="form-control @error('Comentarios') is-invalid @enderror" id="descripcion" type="text" name="Comentarios" value="{{ old('Comentarios') }}">{{old('Comentarios')}}</textarea>
                                                    @error('Comentarios')
                                                    <span class="invalid-feedback" role="alert" style="margin-top:50px;">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror 
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-round btn-success">Calificar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            @endif
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
</div>
<!--MODAL-->


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
