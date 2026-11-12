@extends('layouts.app')

@section('title', 'Nómina y Personal')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Recursos Humanos y Personal Farmacéutico</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> Nuevo Colaborador
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
        <h6 class="m-0 font-weight-bold text-primary">Listado de Personal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Identidad (DNI)</th>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                        <th>Salario Base</th>
                        <th>Fecha Ingreso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($empleados as $emp)
                        <tr>
                            <td class="align-middle font-weight-bold">{{ $emp->identidad }}</td>
                            <td class="align-middle">{{ $emp->nombre }} {{ $emp->apellido }}</td>
                            <td class="align-middle small">{{ $emp->correo }}</td>
                            <td class="align-middle">
                                @switch($emp->cargo)
                                    @case('Regente Farmacéutico')
                                        <span class="badge badge-primary">{{ $emp->cargo }}</span>
                                        @break
                                    @case('Asistente de Farmacia')
                                        <span class="badge badge-info">{{ $emp->cargo }}</span>
                                        @break
                                    @case('Jefe de Bodega')
                                        <span class="badge badge-warning text-dark">{{ $emp->cargo }}</span>
                                        @break
                                    @case('Despachador')
                                        <span class="badge badge-dark">{{ $emp->cargo }}</span>
                                        @break
                                    @default
                                        <span class="badge badge-secondary">{{ $emp->cargo }}</span>
                                @endswitch
                            </td>
                            <td class="align-middle font-weight-bold text-success">
                                L. {{ number_format($emp->salario, 2, '.', ',') }}
                            </td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($emp->fecha_ingreso)->format('d/m/Y') }}
                            </td>
                            <td class="align-middle text-center">
                                @if($emp->estado === 'Activo')
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('empleados.edit', $emp) }}" class="btn btn-warning btn-sm mb-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('empleados.destroy', $emp) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar al colaborador {{ $emp->nombre }} {{ $emp->apellido }}?');">
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
                            <td colspan="8" class="text-center text-muted py-4">No hay personal registrado en la nómina.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $empleados->links() }}
        </div>
    </div>
</div>
@endsection