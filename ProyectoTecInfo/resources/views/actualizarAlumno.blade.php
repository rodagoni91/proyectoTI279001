@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/admiAlumnos">Administración de Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Alumno {{$alumno->name}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Actualizar Alumno {{$alumno->name}}</h4>
                </div>
                <div class="card-body">
                <form method="POST" action="/actualizarAlumno">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">Nombre:</label>
                        <input type="text" required="" name="name"  value="{{$alumno->name}}" class="form-control">
                        @if($errors->has('name'))
                        <span class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>

                

                    <div class="form-group">
                        <label for="email"  style="margin-bottom:-20px; margin-top:-20px;" >Email:</label>
                        <input type="email" required="" class="form-control " style=" margin-top:30px;" readonly value="{{$alumno->email}}" name="email">
                        @if($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Telefono:</label>
                        <input type="text" required="" value="{{$alumno->phone}}" name="Telefono" class="form-control">
                        @if($errors->has('Telefono'))
                        <span class="help-block text-danger">
                            {{ $errors->first('Telefono') }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Direccion:</label>
                        <input type="text" required="" value="{{$alumno->Direccion}}" name="Direccion" class="form-control">
                        @if($errors->has('Direccion'))
                        <span class="help-block text-danger">
                            {{ $errors->first('Direccion') }}
                        </span>
                        @endif
                    </div>

                </div>

                <input type="hidden" name="idAlumno" value="{{$alumno->idAlumno}}">
                <div class="row justify-content-center" style="margin-top: 50px;">
                    <button type="submit" class="btn btn-round btn-primary">Actualizar</button>
                    <a href="/admiProfesores" class="btn btn-round btn-danger">Cancelar</a>
                </div>


            </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection