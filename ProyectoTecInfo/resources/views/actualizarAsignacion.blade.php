@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
   @extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/administracionCursos">Administración de Cursos</a></li>
    @extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/administracionCursos">Administración de Cursos</a></li>
    <li class="breadcrumb-item"><a href="/detalleCurso/{{$curso->idCurso}}">Detalles de {{$curso->NombreCurso}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Asignacion de {{$detalle->NombreProfesor}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3"> 
        <div class="col"> 
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Actualizar Asignacion de {{$detalle->NombreProfesor}}</strong><br></h4>
                </div>
                    <div class="card-body">
                        <form method="POST" action="/actualizarAsignacion">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Nombre del Profesor:</label>
                                <select class="form-control" name="idProfesor" style="margin-bottom:20px; margin-top:20px;"  required="">
                                    @foreach($profesores as $profesor)
                                    @if($profesor->idProfesor == $detalle->idProfesor)
                                    <option value={{$profesor->idProfesor}} selected>{{$profesor->name}}</option>
                                    @endif
                                    @if($profesor->idProfesor != $detalle->idProfesor)
                                    <option value={{$profesor->idProfesor}}>{{$profesor->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-top:25px;">
                                <label for="Hora">Hora:</label>
                                <select class="form-control" name="Hora" style="margin-bottom:20px; margin-top:20px;"  required="">
                                    <option value="{{$detalle->Hora}}">{{$detalle->Hora}}</option>
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
                            <input type="hidden" name="idDetalle" value="{{$detalle->idDetalleCurso}}">
                            <div class="row justify-content-center" style="margin-top: 50px;">
                                <button type="submit" class="btn btn-round btn-primary">Actualizar Asignacion</button>
                                <a href="/adminUsuarios" class="btn btn-round btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    <li class="breadcrumb-item active" aria-current="page">Actualizar Curso {{$curso->NombreCurso}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col"> 
            <div class="card">
                <div class="card-text text-center"><h3>Editar Usuario</h3></div>
                    <div class="card-body">
                        <form method="POST" action="/actualizarCurso">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Nombre del Cursp:</label>
                                <input type="text" required="" value="{{$curso->NombreCurso}}" name="Nombre" class="form-control">
                                @if($errors->has('Nombre'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('Nombre') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="idTipoUsuario">Dias:</label>
                                <select class="form-control" name="Dias" style="margin-bottom:20px; margin-top:20px;"  required="">
                                    @if($curso->Dias == 'Diaria')
                                    <option value="Diaria" selected>Diaria</option>
                                    <option value="Terciada">Terciada</option>
                                    @endif
                                    @if($curso->Dias == 'Terciada')
                                    <option value="Diaria">Diaria</option>
                                    <option value="Terciada" selected>Terciada</option>
                                    @endif
                                </select>
                            </div>
                            <input type="hidden" name="idCurso" value="{{$curso->idCurso}}">
                            <div class="row justify-content-center" style="margin-top: 50px;">
                                <button type="submit" class="btn btn-round btn-primary">Actualizar Curso</button>
                                <a href="/adminUsuarios" class="btn btn-round btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    <li class="breadcrumb-item active" aria-current="page">Actualizar Curso {{$curso->NombreCurso}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col"> 
            <div class="card">
                <div class="card-text text-center"><h3>Editar Usuario</h3></div>
                    <div class="card-body">
                        <form method="POST" action="/actualizarCurso">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Nombre del Cursp:</label>
                                <input type="text" required="" value="{{$curso->NombreCurso}}" name="Nombre" class="form-control">
                                @if($errors->has('Nombre'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('Nombre') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="idTipoUsuario">Dias:</label>
                                <select class="form-control" name="Dias" style="margin-bottom:20px; margin-top:20px;"  required="">
                                    @if($curso->Dias == 'Diaria')
                                    <option value="Diaria" selected>Diaria</option>
                                    <option value="Terciada">Terciada</option>
                                    @endif
                                    @if($curso->Dias == 'Terciada')
                                    <option value="Diaria">Diaria</option>
                                    <option value="Terciada" selected>Terciada</option>
                                    @endif
                                </select>
                            </div>
                            <input type="hidden" name="idCurso" value="{{$curso->idCurso}}">
                            <div class="row justify-content-center" style="margin-top: 50px;">
                                <button type="submit" class="btn btn-round btn-primary">Actualizar Curso</button>
                                <a href="/adminUsuarios" class="btn btn-round btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection