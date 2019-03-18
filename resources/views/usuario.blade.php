@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/usuario.min.css') }}">    
@endsection

@section('content')

<main class="container" id="usuario">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1 class="text-center"><button class="btn btn-primary" data-toggle="modal" data-target="#crearusuario">Crear usuario</button></h1></div>

                <div class="card-body">
                   <table class="table" id="table_usuario">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Avatar</th>
                               <th>Identificación</th>
                               <th>Nombre</th>
                               <th>Email</th>
                               <th>Rol</th>
                               <th>Opciones</th>
                           </tr>
                       </thead>
                   </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal para crear usuario --}}
    @include('modal.crearUsuario')

    {{-- modal para editar usuario --}}
    @include('modal.editarUsuario')
</main>
@endsection

@section('script')
 <script src="{{ asset('js/usuario.min.js') }}"></script>
@endsection
