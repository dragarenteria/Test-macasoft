@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                        @hasrole('Administrador')
                       <h5>Usted tiene permisos de Administrador</h5>
                    @endhasrole
                    @hasrole('Usuario')
                       <h5>Usted tiene permisos de Usuario</h5>
                    @endhasrole
                    @hasrole('Vendedor')
                       <h5>Usted tiene permisos de Vendedor</h5>
                    @endhasrole
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
