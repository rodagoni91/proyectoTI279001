@extends('layouts.admin')
@section('contenido')
<div class="container" style="margin-top:50px;">
    <ol class="breadcrumb" style="z-index: 999;margin-top:60px;">
        <li class="breadcrumb-item"><a href="/home">Panel</a></li>
        <li class="breadcrumb-item"><a href="/administracionCursos">Administracion de Cursos</a></li>
        <li class="breadcrumb-item active">Detalles de {{$curso->NombreCurso}}</li>  
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
                    <h4 class="card-title ">Detalles de <strong>{{$curso->NombreCurso}}</strong><br></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <h4>
                                <strong>Nombre del Curso:</strong> {{$curso->NombreCurso}}<br>
                                <strong>Dias:</strong> {{$curso->Dias}}<br>
                            </h4>
                        </div>
                        <div class="col-sm-4 col-md-4"></div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <a style="color:white;" class="btn btn-round btn-primary  btn-sm" data-toggle="modal" data-target="#insertUser">Asignar Profesor</a>
                        </div>
                    </div>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre del Profesor</th>
                                <th>Hora</th>
                                <th>Codigo Curso</th>
                                <th>Creado el</th>
                                <th class="disabled-sorting ">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>Nombre del Profesor</th>
                            <th>Hora</th>
                            <th>Codigo Curso</th>
                            <th>Creado el</th>
                            <th class="disabled-sorting ">Acciones</th>
                        </tfoot>
                        <tbody>
                            @foreach($cursos as $kurso)
                            <tr>
                                <td>{{$kurso->NombreProfesor}}</td> 
                                <td>{{$kurso->Hora}}</td>
                                <td>{{$kurso->CodigoCurso}}</td>
                                <td>
                                  @php
                                      $date = Date::parse($kurso->created_at);
                                      echo $date->format('l d F Y');
                                  @endphp
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-round btn-warning btn-icon btn-sm" href="/actualizarAsignacion/{{$kurso->idDetalleCurso}}" ><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-round btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal{{$kurso->idDetalleCurso}}"><i class="fas fa-times"></i></a>
                                    <div class="modal fade" id="exampleModal{{$kurso->idDetalleCurso}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$kurso->idDetalleCurso}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{$kurso->idDetalleCurso}}">Borrar asignacion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/eliminarAsignacion" method="post" >
                                                    {{csrf_field()}}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idCurso" value="{{$curso->idCurso}}">
                                                        <input type="hidden" name="idDetalleCurso" value="{{$kurso->idDetalleCurso}}">
                                                        <p style="float:left;">
                                                        Estas seguro que quieres eliminar la asignacion a {{$kurso->NombreProfesor}}?<br><br><br><br>
                                                        </p>
                                                        <br><br><br><br>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-round btn-danger">Eliminar</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
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

<!--MODAL-->
<div class="modal fade" id="insertUser" tabindex="-1" role="dialog" aria-labelledby="validarCodigo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Profesor a {{$curso->NombreCurso}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="/asignarProfesor">
            {{csrf_field()}}
            <input type="hidden" name="idCurso" value="{{$curso->idCurso}}">
            <div class="form-group">
                <label for="email">Nombre del Profesor:</label>
                <select class="form-control" name="idProfesor" style="margin-bottom:20px; margin-top:20px;"  required="">
                    @foreach($profesores as $profesor)
                    <option value={{$profesor->idProfesor}}>{{$profesor->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-top:25px;">
                <label for="Hora">Hora:</label>
                <select class="form-control" name="Hora" style="margin-bottom:20px; margin-top:20px;"  required="">
                    <option value="7:00">7:00</option>
                    <option value="8:00">8:00</option>
                    <option value="9:00">9:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
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
