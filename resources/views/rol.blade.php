@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rol.min.css') }}">    
@endsection

@section('content')

<main class="container" id="rol_main">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h1 class="text-center"><button class="btn btn-primary" data-toggle="modal" data-target="#crearRol">Crear rol</button></h1></div>

                <div class="card-body">
                   <table class="table" id="table_rol">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Nombre</th>
                               <th>Acciones</th>
                           </tr>
                       </thead>
                   </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal para crear rol --}}
    <form class="modal fade" id="crearRol" tabindex="-1" role="dialog"
@submit.prevent="guardarRol()" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="form-group col-md-12">
                        <label for="rol">Rol</label>
                        <input type="text" required class="form-control" v-model='rol'  id="rol" placeholder="Escriba el nombre del rol">
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
  </form>

  

</main>
@endsection

@section('script')
 <script src="{{ asset('js/rol.min.js') }}"></script>
@endsection