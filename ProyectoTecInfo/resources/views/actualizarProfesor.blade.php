@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/admiProfesores">Administración de Profesores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Profesor {{$usuario->name}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col">
            <div class="card">
                <div class="card-text text-center"><h3>Editar Profesor</h3></div>
                <div class="card-body">
                <form method="POST" action="/actualizarProfesor">
                {{csrf_field()}}
                <div class="form-group">
                <label for="email">Nombre:</label>
                <input type="text" required="" name="name"  value="{{$usuario->name}}" class="form-control">
                @if($errors->has('name'))
                <span class="help-block text-danger">
                    {{ $errors->first('name') }}
                </span>
                @endif
                </div>

                

                <div class="form-group">
                    <label for="email"  style="margin-bottom:-20px; margin-top:-20px;" >Email:</label>
                
                <input type="email" required="" class="form-control " style=" margin-top:30px;" readonly value="{{$usuario->email}}" name="email">
                @if($errors->has('email'))
                <span class="help-block text-danger">
                    {{ $errors->first('email') }}
                </span>
                @endif
                </div>

                <div class="form-group">
                <label for="email">Telefono:</label>
                <input type="text" required="" value="{{$usuario->phone}}" name="Telefono" class="form-control">
                @if($errors->has('Telefono'))
                <span class="help-block text-danger">
                    {{ $errors->first('Telefono') }}
                </span>
                @endif
            </div>

                </div>
                <input type="hidden" name="idUsuario" value="{{$usuario->id}}">
                <div class="row justify-content-center">
                <button type="submit" class="btn btn-round btn-primary">Actualizar</button>
                <a href="/adminUsuarios" class="btn btn-round btn-danger">Cancelar</a>
                </div>


            </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection