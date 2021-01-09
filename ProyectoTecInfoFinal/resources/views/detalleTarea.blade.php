@extends('layouts.admin')
@section('contenido')
<div class="container" style="margin-top:50px;">
    <ol class="breadcrumb" style="z-index: 999;margin-top:60px;">
        <li class="breadcrumb-item"><a href="/home">Panel</a></li>
        <li class="breadcrumb-item"><a href="/misTareas">Mis Tareas</a></li>
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
                               <strong>Fecha de Entrega:</strong>  @php
                                    $date = Date::parse($entregas->created_at);
                                    echo $date->format('l d F Y');
                                @endphp<br> 
                                @if($entregas != null)
                                <strong>Calificacion:</strong> {{$entregas->Calificacion}}<br>
                                <strong>Observaciones:</strong> {{$entregas->Observaciones}}<br>
                                @endif
                                <br>
                                @if($entregas == null)
                                <strong style="color:red;">La Tarea Aun No A Sido Entregada</strong><br>
                                
                                @endif
                            </h4>
                        </div>
                        
                       
                    </div>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>

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
