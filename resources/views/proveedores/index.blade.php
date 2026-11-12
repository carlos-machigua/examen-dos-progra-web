HTML
@extends('layouts.app')

@section('title', 'Laboratorios y Proveedores')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laboratorios y Proveedores Mayoristas</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Proveedor
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Directorio de Suplidores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>RTN</th>
                        <th>Empresa / Razón Social</th>
                        <th>Asesor Comercial</th>
                        <th>Teléfono</th>
                        <th>Categoría</th>
                        <th>Crédito Asignado</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proveedores as $prov)
                        <tr>
                            <td class="align-middle font-weight-bold">{{ $prov->rtn }}</td>
                            <td class="align-middle">{{ $prov->empresa }}</td>
                            <td class="align-middle">{{ $prov->contacto }}</td>
                            <td class="align-middle">{{ $prov->telefono }}</td>
                            <td class="align-middle">{{ $prov->categoria }}</td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">L. {{ number_format($prov->limite_credito, 2) }}</div>
                                <span class="badge badge-info">{{ $prov->dias_credito }} días</span>
                            </td>
                            <td class="align-middle text-center">
                                @if($prov->estado === 'Activo')
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="align-middle small">{{ $prov->fecha_registro }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('proveedores.edit', $prov) }}" class="btn btn-warning btn-sm mb-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('proveedores.destroy', $prov) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar al proveedor {{ $prov->empresa }}?');">
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
                            <td colspan="9" class="text-center text-muted py-4">No hay proveedores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $proveedores->links() }}
        </div>
    </div>
</div>
@endsection