@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Modificar Usuario</h4>
                        </div>
                        <div class="card-body">
                            <form action=" {{ route('usuarios.update', $usuario->id) }} " method="post" novalidate>
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="rol">Roles</label>
                                    <div class="form-check">
                                        @foreach ($roles as $rol)
                                            <input type="checkbox" class="form-check-input" id="role{{ $rol->id }}" name="roles[]" value="{{ $rol->id }}" @if($usuario->roles->pluck('id')->contains($rol->id)) checked @endif>
                                            <label class="form-check-label" for="role{{ $rol->id }}">
                                                {{ $rol->name }}
                                            </label><br>
                                        @endforeach
                                    </div>
                                    @error('rol_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                                
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Nombre del usuario"
                                        value="{{ $usuario->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email del usuario"
                                        value="{{ $usuario->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Nueva Contraseña</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                           id="new_password" name="new_password" placeholder="Nueva Contraseña">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                           id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirmar Nueva Contraseña">
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div
                                        class="col-md-6 offset-md-6 d-flex flex-md-row flex-column justify-content-between">
                                        <button type="submit"
                                            class="btn btn-success mb-2 mb-md-0 flex-fill mx-1">Guardar</button>
                                        <button type="reset" class="btn btn-secondary flex-fill mx-1">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
