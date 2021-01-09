@extends('layouts.admin')
@section('contenido')

<div class="container" style="margin-top:20px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/home">Panel</a></li>
    <li class="breadcrumb-item"><a href="/admiUsuarios">Administración de Tareas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actualizar Tarea {{$tarea->TituloTarea}}</li>
  </ol>
</div>

<div class="container">
    <div class="row px-3 py-3">
        <div class="col">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Actualizar Tarea {{$tarea->TituloTarea}}</h4>
              </div>
            <div class="card-body">
                <form method="POST" action="/actualizarTarea">
                {{csrf_field()}}


                <div class="form-group">
                    <label for="email">Titulo:</label>
                    <input type="text" required="" name="TituloTarea"  value="{{$tarea->TituloTarea}}" class="form-control">
                    @if($errors->has('TituloTarea'))
                    <span class="help-block text-danger">
                        {{ $errors->first('TituloTarea') }}
                    </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="email">Descripcion:</label>
                    <textarea class="form-control @error('DescripcionTarea') is-invalid @enderror" id="descripcion" type="text" name="DescripcionTarea" value="{{ old('descripcion') }}">{{$tarea->DescripcionTarea}}</textarea>
                    @error('DescripcionTarea')
                    <span class="invalid-feedback" role="alert" style="margin-top:50px;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>

                <div class="form-group">
                    <label for="email">Fecha:</label>
                    <input class="form-control"  value="{{$tarea->Fecha}}" type="date" id="start" name="Fecha"  min="1900-01-01" max="2100-12-31">
                    @if($errors->has('Fecha'))
                    <span class="help-block text-danger">
                    El campo fecha debe ser una fecha posterior o igual al día de hoy.
                    </span>
                    @endif
                </div>  

                <div class="form-group" style="margin-bottom:40px;">
                    <label class="bmd-label-floating">Hora:</label>
                    <select class="form-control" required="" name="hora" style="margin-top:25px;">
                            <option value="">Seleccionar...</option>
                            @foreach($horas as $hora)
                                @if($hora == $tarea->Hora)
                                <option value="{{$hora}}" selected>{{$hora}}</option>
                                @endif
                                @if($hora != $tarea->Hora)
                                <option value="{{$hora}}">{{$hora}}</option>
                                @endif
                            @endforeach
                    </select>
                </div>

            </div>

               
               
            <input type="hidden" name="idTarea" value="{{$tarea->idTarea}}">
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