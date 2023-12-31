<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        @can('ventas.create')
                        <a href="{{ route('ventas.create') }}" type="button" class="btn" style="background: #3B3F5C; color:white">
                            <i class="fas fa-plus"></i> Nueva Venta
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="ventas">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Items</th>
                                        <th>Pago</th>
                                        <th>Cambio</th>
                                        <th>Sucursal</th>
                                        <th>Vendedor</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td>{{ $venta->id }}</td>
                                            <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                                            <td>Bs. {{ $venta->total }}</td>
                                            <td>{{ $venta->items }}</td>
                                            <td>Bs. {{ $venta->cash }} </td>
                                            <td>Bs. {{ $venta->cambio }}</td>
                                            <td>{{ $venta->almacen->nombre }}</td>
                                            <td>{{ $venta->user->name }}</td>
                                            <td>{{ $venta->cliente->razon_social }}</td>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $venta->estado === 'pagado' ? 'success' : 'warning' }}">
                                                    {{ $venta->estado }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center ">
                                                <a href="{{ route('ventas.pdf', $venta) }}" target="_blank" class="btn btn-outline-danger btn-sm mr-1">
                                                    <i class="fas fa-file-pdf"></i> PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

