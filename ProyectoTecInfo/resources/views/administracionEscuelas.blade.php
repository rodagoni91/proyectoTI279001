@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:50px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item active">Administración de Escuelas</li>
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
              <a style="color:white;" class="btn btn-round btn-primary" data-toggle="modal" data-target="#insertUser">Insertar Escuela</a>
            </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Administración de Escuelas</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nombre de la Escuela</th>
                      <th>Nombre del Director</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Creado el</th>
                      <th class="disabled-sorting ">Acciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <th>Nombre de la Escuela</th>
                    <th>Nombre del Director</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Creado el</th>
                    <th class="disabled-sorting ">Acciones</th>

                  </tfoot>
                  <tbody>
                  @foreach($escuelas as $escuela)
                    <tr>
                      <td>{{$escuela->nombreEscuela}}</td>
                      <td>{{$escuela->Director}}</td>
                      <td>{{$escuela->Direccion}}</td>
                      <td>{{$escuela->Telefono}}</td>
                      <td>
                        @php
                            $date = Date::parse($escuela->created_at);
                            echo $date->format('l d F Y');
                        @endphp
                      </td>

                      <td class="text-center">
                           <a class="btn btn-round btn-warning btn-icon btn-sm" href="/actualizarEscuela/{{$escuela->idEscuela}}" ><i class="fas fa-edit"></i></a>
                             <a href="#" class="btn btn-round btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#exampleModal{{$escuela->idEscuela}}"><i class="fas fa-times"></i></a>


                                <div class="modal fade" id="exampleModal{{$escuela->idEscuela}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$escuela->idEscuela}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{$escuela->idEscuela}}">Borrar usuario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/eliminarEscuela" method="post" >
                                              {{csrf_field()}}
                                                <div class="modal-body">

                                                    <input type="hidden" name="idEscuela" value="{{$escuela->idEscuela}}">
                                                    <p style="float:left;">
                                                    Estas seguro que quieres eliminar la escuela {{$escuela->nombreEscuela}}?<br><br><br><br>
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

<!--MODAL-->

<div class="modal fade" id="insertUser" tabindex="-1" role="dialog" aria-labelledby="validarCodigo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

        <form method="POST" action="/insertarEscuela">
            {{csrf_field()}}
            <input type="hidden" name="phone" value="555"> 
            <div class="form-group">
                <label for="email">Nombre de la Escuela:</label>
                <input type="text" required="" value="{{old('name')}}" name="name" class="form-control">
                @if($errors->has('name'))
                <span class="help-block text-danger">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" required="" value="{{old('email')}}" class="form-control" placeholder="" name="email">
                @if($errors->has('email'))
                    <span class="help-block text-danger">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Nombre del Director:</label>
                <input type="text" required="" value="{{old('Director')}}" name="Director" class="form-control">
                @if($errors->has('Director'))
                <span class="help-block text-danger">
                    {{ $errors->first('Director') }}
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Direccion:</label>
                <input type="text" required="" value="{{old('direccion')}}" name="direccion" class="form-control">
                @if($errors->has('direccion'))
                <span class="help-block text-danger">
                    {{ $errors->first('direccion') }}
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Telefono:</label>
                <input type="text" required="" value="{{old('Telefono')}}" name="Telefono" class="form-control">
                @if($errors->has('Telefono'))
                <span class="help-block text-danger">
                    {{ $errors->first('Telefono') }}
                </span>
                @endif
            </div>

            

            
            <br><br>
            <small class="text-center text-muted">**La contraseña por default será: "password"</small>
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