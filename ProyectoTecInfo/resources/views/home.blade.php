@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row py-5 " style="vertical-align: middle;">
        @if(Auth::user()->idTipoUsuario == 1)
        <!--Administrar usuarios-->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/admiUsuarios">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-user"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Usuarios</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/admiEscuelas">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-school"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Escuelas</h3>
                    </div>
                </div>
            </a>
        </div>
        

        @endif

        @if(Auth::user()->idTipoUsuario == 2)
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/admiEscuelas">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-school"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Escuelas</h3>
                    </div>
                </div>
            </a>
        </div>
       
        @endif

        @if(Auth::user()->idTipoUsuario == 3)
        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/admiProfesores">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Profesores</h3>
                    </div>
                </div>
            </a>
        </div>
       

        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/administracionCursos">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-chalkboard"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Cursos</h3>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/admiAlumnos">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-user-graduate"></i>
                        </div>
                        <p class="card-category">Administrar</p>
                        <h3 class="card-title">Alumnos</h3>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">
            <a href="/actualizarEscuela/{{$escuela->idEscuela}}">
                <div class="card card-stats mx-auto" style="height:150px; width: 100%">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon" style="linear-gradient(60deg, #2BD141, #2BD141) !important;">
                        <i class="fas fa-cog"></i>
                        </div>
                        <p class="card-category">Configuracion</p>
                        <h3 class="card-title">Mis Datos</h3>
                    </div>
                </div>
            </a>
        </div>

        @endif



    </div>

</div>
@endsection
