@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/administracionCursos">Administración de Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Curso {{$curso->NombreCurso}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col"> 
            <div class="card">
            <div class="card-header card-header-primary"><h4 class="card-title">Actualizar Curso {{$curso->NombreCurso}}</h4></div>
                    <div class="card-body">
                        <form method="POST" action="/actualizarCurso">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Nombre del Curso:</label>
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