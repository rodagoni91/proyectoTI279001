@extends('layouts.admin')
@section('contenido')
<div class="container" style="margin-top:50px;">
    <ol class="breadcrumb" style="z-index: 999;margin-top:60px;">
        <li class="breadcrumb-item"><a href="/home">Panel</a></li>
        <li class="breadcrumb-item"><a href="/misCursosInscritos">Mis Cursos Inscritos</a></li>
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
                        <div class="col-sm-6 col-md-6">
                            <h4>
                                <strong>Nombre del Profesor:</strong> {{$profesor->NombreProfesor}}<br>
                                <strong>eMail del Profesor:</strong> {{$profesor->emailProfesor}}<br>
                                <strong>Nombre del Curso:</strong> {{$curso->NombreCurso}}<br>
                                <strong>Dias:</strong> {{$curso->Dias}}<br>
                                <strong>Hora:</strong> {{$curso->Hora}} hras.<br>
                            </h4>
                        </div>
                        <div class="col-sm-2 col-md-2"></div>
                        <div class="col-sm-2 col-md-2">
                       
                        </div>
                        <div class="col-md-12 col-sm-12  text-center">
                            <h4><strong>Tareas del Curso</strong></h4>
                        </div>
                    </div>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    
                                    <th>Fecha Entrega</th>
                                    <th class="disabled-sorting ">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>Titulo</th>
                                
                                <th>Fecha Entrega</th>
                                <th class="disabled-sorting">Acciones</th>
                            </tfoot>
                            <tbody>
                                @foreach($tareas as $tarea)
                                    <tr>
                                        <td>{{$tarea->TituloTarea}}</td>
                                        
                                        <td>
                                            @php
                                                $date = Date::parse($tarea->Fecha);
                                                echo $date->format('l d F Y');
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            <abbr title="Detalle de Tarea">
                                                <a class="btn btn-round btn-primary btn-icon btn-primary" href="/detalleTarea/{{$tarea->idTarea}}">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </a>    
                                            </abbr>
                                            <abbr title="Entregar Tarea">
                                                <a style="color:white;" class="btn btn-round btn-primary" data-toggle="modal" data-target="#insertUser">
                                                    <i class="fas fa-book-reader">
                                                    </i>
                                                </a>
                                            </abbr>
                                            <div class="modal fade" id="insertUser" tabindex="-1" role="dialog" aria-labelledby="validarCodigo" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Entregar Tarea</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form method="POST" action="/entregarTarea" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="idTarea" value="{{$tarea->idTarea}}">
                                                                <div class="row justify-content-center" style="margin-bottom:50px;">
                                                                        <label for="name">
                                                                            Archivo PDF, Maximo 10 MegaBytes <strong style="color: red !important;">*</strong>
                                                                        </label>
                                                                    </div>
                                                                <div class="form-group row justify-content-center">
                                                                    

                                                                    <div class="row text-center">
                                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput" data-toggle="tooltip" data-placement="top" > 
                                                                            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                                                            <div>
                                                                            @if($errors->has('imagen'))
                                                                            <span class="help-block text-danger">
                                                                                {{ $errors->first('imagen') }}
                                                                            </span>
                                                                            @endif
                                                                            <span class="btn btn-raised btn-round btn-default btn-file" style="z-index:999;">
                                                                                <input type="file" name="pdf"  accept=".pdf" style="z-index:999;width:180px;height:25px;" placeholder="ejemplo" required>
                                                                                <span class="fileinput-new" style="z-index:0;">Seleccionar Archivo</span> 
                                                                                <span class="fileinput-exists">Cambiar</span>
                                                                            </span>
                                                                            <a href="#pablo" class="btn btn-raised btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                                                                            </div>
                                                                        </div>
                                                                        @error('imagen')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                        </div>
                                                                    </div>      
           
                                                                    
                                                                                                                    
                                                                </div>
                                                                <br>
                                                                <div class="row justify-content-center">
                                                                    <button type="submit"  style="margin-bottom:30px; margin-top:30px;width:200px;"  class="btn btn-round btn-primary" style="background-color:greeen !important;">Entregar</button>
                                                                    <button type="button" style="margin-bottom:30px; margin-top:30px;width:200px;" class="btn btn-round btn-danger" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </form>
                                                        </div>
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
