@extends('layouts.app')

@section('title', 'Inventario de Medicamentos')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inventario Farmacéutico</h1>
    <a href="{{ route('medicamentos.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Medicamento
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <h6 class="m-0 font-weight-bold text-primary mb-2 mb-md-0">Catálogo de Productos</h6>

        <!-- Buscador por nombre o SKU -->
        <form action="{{ route('medicamentos.index') }}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o SKU..." value="{{ $busqueda ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    @if(!empty($busqueda))
                        <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary" title="Limpiar"><i class="fas fa-times"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Foto</th>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Laboratorio / Lote</th>
                        <th>Precio / Costo</th>
                        <th>Existencias</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicamentos as $med)
                        <tr>
                            <td class="text-center align-middle">
                                @if($med->imagen)
                                    <img src="{{ asset($med->imagen) }}" alt="{{ $med->nombre }}" class="img-thumbnail" style="width: 55px; height: 55px; object-fit: cover;">
                                @else
                                    <span class="badge badge-light border p-2 text-muted"><i class="fas fa-pills fa-lg"></i></span>
                                @endif
                            </td>
                            <td class="align-middle font-weight-bold">{{ $med->codigo }}</td>
                            <td class="align-middle">{{ $med->nombre }}</td>
                            <td class="align-middle">{{ $med->categoria }}</td>
                            <td class="align-middle small">
                                <strong>Lab:</strong> {{ $med->laboratorio }}<br>
                                <strong>Lote:</strong> {{ $med->numero_lote }}
                            </td>
                            <td class="align-middle small">
                                <span class="text-success font-weight-bold">L. {{ number_format($med->precio, 2) }}</span><br>
                                <span class="text-muted">Costo: L. {{ number_format($med->costo, 2) }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="font-weight-bold mb-1">{{ $med->inventario }} uds.</div>
                                {{-- Badges semánticos según rúbrica --}}
                                @if($med->inventario > 20)
                                    <span class="badge badge-success">Óptimo</span>
                                @elseif($med->inventario >= 10)
                                    <span class="badge badge-warning text-dark">Moderado</span>
                                @else
                                    <span class="badge badge-danger">¡Desabastecimiento!</span>
                                @endif
                            </td>
                            <td class="align-middle small">
                                <strong>Vence:</strong> {{ $med->fecha_vencimiento }}<br>
                                <span class="text-muted">Reg: {{ $med->fecha_registro }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('medicamentos.edit', $med) }}" class="btn btn-warning btn-sm mb-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('medicamentos.destroy', $med) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar el medicamento {{ $med->nombre }} ({{ $med->codigo }})?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No se encontraron medicamentos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-end mt-3">
            {{ $medicamentos->links() }}
        </div>
    </div>
</div>
@endsection