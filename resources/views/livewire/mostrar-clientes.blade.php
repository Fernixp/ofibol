<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        @can('clientes.create')
                        <button type="button" class="btn" style="background: #3B3F5C; color:white" data-toggle="modal" data-target="#nuevoClienteModal">
                            <li class="fa fa-plus"></li> Registrar Cliente
                        </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <div class="table-responsive" style="max-height:500px; overflow-x:auto;"> --}}
                            <table class="table table-bordered table-striped" id="clientes">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Razon Social</th>
                                        <th>Nit</th>
                                        <th>Telefono</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->razon_social }}</td>
                                            <td>{{ $cliente->nit }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>{{ $cliente->direccion }}</td>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $cliente->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $cliente->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center ">
                                                @can('clientes.edit')
                                                {{-- Editar --}}
                                                <a class="btn btn-warning btn-sm mr-1 mb-1 edit-button"
                                                    href="{{ route('clientes.edit', $cliente->id) }}"><i
                                                        class="fas fa-pen"></i></a>
                                                {{-- Eliminar --}}
                                                </button>
                                                @endcan
                                                @can('clientes.destroy')
                                                <button type="button"
                                                    wire:click="$emit('{{ $cliente->estado === '1' ? 'alertaInactivar' : 'alertaActivar' }}',{{ $cliente->id }})"
                                                    class="btn btn-outline-{{ $cliente->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"><i
                                                        class="fas {{ $cliente->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
                                                </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- Modal para crear clientes --}}
    <div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoClienteModalLabel">Registrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Aca vamos a llamar al componente livewire para registrar un nuevo cliente --}}
                    <livewire:crear-cliente />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
