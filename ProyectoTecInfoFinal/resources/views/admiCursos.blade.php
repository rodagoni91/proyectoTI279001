@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:50px;">
  @if(Auth::user()->idTipoUsuario == 3)
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item active">Administración de Cursos</li>
  </ol>
  @endif
  @if(Auth::user()->idTipoUsuario == 4)
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item active">Mis Cursos</li>
  </ol>
  @endif

  @if(Auth::user()->idTipoUsuario == 5)
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item active">Cursos</li>
  </ol>
  @endif
</div>
 <!-- End Navbar -->

      <div class="container">

          <div class="row ">
           <div class="col-md-6">
            </div>
            <div class="col-md-3">
              <!--<a style="color:white;" class="btn btn-round btn-sucess"  href="/admiUsuariosInhabilitados">Usuarios Inhabilitados</a>-->
            </div>
            @if(Auth::user()->idTipoUsuario != 5 && Auth::user()->idTipoUsuario != 4)
            <div class="col-md-3">
              <a style="color:white;" class="btn btn-round btn-primary" data-toggle="modal" data-target="#insertUser">Dar de Alta un Curso</a>
            </div>
            @endif
          <div class="col-md-12">
            <div class="card">
              @if(Auth::user()->idTipoUsuario != 5)
              <div class="card-header card-header-primary">
                <h4 class="card-title">Administración de Cursos</h4>
              </div>
              @endif
              @if(Auth::user()->idTipoUsuario == 5)
              <div class="card-header card-header-primary">
                <h4 class="card-title">Cursos</h4>
              </div>
              @endif
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                @if(Auth::user()->idTipoUsuario != 5)
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nombre del Curso</th>
                      <th>Dias</th>
                      <th>Creado el</th>
                      <th class="disabled-sorting ">Acciones</th>
                    </tr> 
                  </thead>
                  <tfoot>
                      <th>Nombre del Curso</th>
                      <th>Dias</th>
                      <th>Creado el</th>
                      <th class="disabled-sorting ">Acciones</th>
                  </tfoot>
                  <tbody>
                  @foreach($cursos as $curso)
                    <tr>
                      <td>{{$curso->NombreCurso}}</td>
                      <td>{{$curso->Dias}}</td>
                      
                      <td>
                        @php
                            $date = Date::parse($curso->created_at);
                            echo $date->format('l d F Y');
                        @endphp
                      </td>

                      <td class="text-center">
                        @if(Auth::user()->idTipoUsuario == 3)
                        <a class="btn btn-round btn-primary btn-icon btn-sm" href="/detalleCurso/{{$curso->idCurso}}" ><i class="fas fa-eye"></i></a>
                        <a class="btn btn-round btn-warning btn-icon btn-sm" href="/actualizarCurso/{{$curso->idCurso}}" ><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-round btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal{{$curso->idCurso}}"><i class="fas fa-times"></i></a>
                        <div class="modal fade" id="exampleModal{{$curso->idCurso}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$curso->idCurso}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{$curso->idCurso}}">Borrar usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/eliminarCurso" method="post" >
                                      {{csrf_field()}}
                                        <div class="modal-body">

                                            <input type="hidden" name="idCurso" value="{{$curso->idCurso}}">
                                            <p style="float:left;">
                                            Estas seguro que quieres eliminar el curso {{$curso->NombreCurso}}?<br><br><br><br>
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
                        @endif
                        @if(Auth::user()->idTipoUsuario == 4)
                        <a class="btn btn-round btn-primary btn-icon btn-sm" href="/detalleMiCurso/{{$curso->idDetalleCurso}}" ><i class="fas fa-eye"></i></a>
                        @endif
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                @endif

                @if(Auth::user()->idTipoUsuario == 5)
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nombre del Curso</th>
                      <th>Dias</th>
                      <th>Hora</th>
                      <th>Profesor</th>
                      <th class="disabled-sorting ">Inscribir Materia</th>
                    </tr> 
                  </thead>
                  <tfoot>
                      <th>Nombre del Curso</th>
                      <th>Dias</th>
                      <th>Hora</th>
                      <th>Profesor</th>
                      <th class="disabled-sorting ">Inscribir Materia</th>
                  </tfoot>
                  <tbody>
                  @foreach($cursos as $curso)
                    <tr>
                      <td>{{$curso->NombreCurso}}</td>
                      <td>{{$curso->Dias}}</td>
                      <td>{{$curso->Hora}}</td>
                      <td>{{$curso->NombreProfesor}}</td>

                      <td class="text-center">
                      <a style="color:white;" class="btn btn-round btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#insertUser"><i class="fas fa-chalkboard"></i></a>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                @endif
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
      @if(Auth::user()->idTipoUsuario == 5)
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Inscribir Materia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="POST" action="/inscribirCurso">
              {{csrf_field()}}
              
              <div class="form-group">
                  <label for="email">Codigo del Curso:</label>
                  <input type="text" required value="{{old('Codigo')}}" name="Codigo" class="form-control">
                  @if($errors->has('Codigo'))
                  <span class="help-block text-danger">
                      {{ $errors->first('Codigo') }}
                  </span>
                  @endif
              </div>
              <div class="form-group">
            
              <br>
              <div class="row justify-content-center">
              <button type="submit"  style="margin-bottom:30px; margin-top:30px;width:200px;"  class="btn btn-round btn-primary" style="background-color:greeen !important;">Inscribirse</button>
              <button type="button" style="margin-bottom:30px; margin-top:30px;width:200px;" class="btn btn-round btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
          </form>
        </div>
      @endif
      @if(Auth::user()->idTipoUsuario == 3)
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Curso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="POST" action="/insertarCurso">
              {{csrf_field()}}
              <input type="hidden" name="idEscuela" value="{{$escuela->idEscuela}}">
              <div class="form-group">
                  <label for="email">Nombre del Curso:</label>
                  <input type="text" required="" value="{{old('Nombre')}}" name="Nombre" class="form-control">
                  @if($errors->has('Nombre'))
                  <span class="help-block text-danger">
                      {{ $errors->first('Nombre') }}
                  </span>
                  @endif
              </div>
              <div class="form-group">
                  <label for="idTipoUsuario">Dias:</label>
                  <select class="form-control" name="Dias" style="margin-bottom:20px; margin-top:20px;"  required="">

                      <option value="Diaria">Diaria</option>
                      <option value="Terciada">Terciada</option>
                  </select>
              </div>
              <br>
              <div class="row justify-content-center">
              <button type="submit"  style="margin-bottom:30px; margin-top:30px;width:200px;"  class="btn btn-round btn-primary" style="background-color:greeen !important;">Insertar</button>
              <button type="button" style="margin-bottom:30px; margin-top:30px;width:200px;" class="btn btn-round btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
          </form>
        </div>
      @endif
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
