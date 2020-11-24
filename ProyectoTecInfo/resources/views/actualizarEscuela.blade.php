@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/admiEscuelas">Administración de Escuelas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Escuela {{$escuela->nombreEscuela}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col"> 
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Actualizar Escuela {{$escuela->nombreEscuela}}</h4>
                </div>
                <div class="card-body">
                <form method="POST" action="/actualizarEscuela">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="email">Nombre de la Escuela:</label>
                    <input type="text" required="" name="name"  value="{{$escuela->nombreEscuela}}" class="form-control">
                    @if($errors->has('name'))
                    <span class="help-block text-danger">
                        {{ $errors->first('name') }}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email"  style="margin-bottom:-20px; margin-top:-20px;" >Email:</label>
                    <input type="email" required="" class="form-control " style=" margin-top:30px;" readonly value="{{$escuela->email}}" name="email">
                    @if($errors->has('email'))
                    <span class="help-block text-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>

                <div class="form-group">
                <label for="email">Nombre del Director:</label>
                <input type="text" required="" value="{{$escuela->Director}}" name="Director" class="form-control">
                @if($errors->has('Director'))
                <span class="help-block text-danger">
                    {{ $errors->first('Director') }}
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Direccion:</label>
                <input type="text" required="" value="{{$escuela->Direccion}}" name="direccion" class="form-control">
                @if($errors->has('direccion'))
                <span class="help-block text-danger">
                    {{ $errors->first('direccion') }}
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Telefono:</label>
                <input type="text" required="" value="{{$escuela->Telefono}}" name="Telefono" class="form-control">
                @if($errors->has('Telefono'))
                <span class="help-block text-danger">
                    {{ $errors->first('Telefono') }}
                </span>
                @endif
            </div>

              
                </div>
                    <input type="hidden" name="idEscuela" value="{{$escuela->idEscuela}}">
                    <div class="row justify-content-center">
                    <button type="submit" class="btn btn-round btn-primary">Actualizar Escuela</button>
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