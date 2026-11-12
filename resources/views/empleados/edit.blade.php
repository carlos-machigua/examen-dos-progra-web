@extends('layouts.app')

@section('title', 'Editar Colaborador')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Colaborador: {{ $empleado->nombre }} {{ $empleado->apellido }}</h1>
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('empleados.update', $empleado) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Identidad / DNI (13 dígitos sin guiones) *</label>
                    <input type="text" name="identidad" maxlength="13" value="{{ old('identidad', $empleado->identidad) }}"
                           class="form-control @error('identidad') is-invalid @enderror" required>
                    @error('identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre) }}"
                           class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Apellido *</label>
                    <input type="text" name="apellido" value="{{ old('apellido', $empleado->apellido) }}"
                           class="form-control @error('apellido') is-invalid @enderror" required>
                    @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Correo Electrónico *</label>
                    <input type="email" name="correo" value="{{ old('correo', $empleado->correo) }}"
                           class="form-control @error('correo') is-invalid @enderror" required>
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Cargo *</label>
                    <select name="cargo" class="form-control @error('cargo') is-invalid @enderror" required>
                        @foreach(['Regente Farmacéutico', 'Asistente de Farmacia', 'Jefe de Bodega', 'Despachador', 'Cajero'] as $cargo)
                            <option value="{{ $cargo }}" {{ old('cargo', $empleado->cargo) == $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                        @endforeach
                    </select>
                    @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Salario Base Mensual (L.) *</label>
                    <input type="number" step="0.01" min="0.01" name="salario" value="{{ old('salario', $empleado->salario) }}"
                           class="form-control @error('salario') is-invalid @enderror" required>
                    @error('salario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fecha de Ingreso *</label>
                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}"
                           class="form-control @error('fecha_ingreso') is-invalid @enderror" required>
                    @error('fecha_ingreso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Estado *</label>
                    <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado', $empleado->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $empleado->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Actualizar Colaborador
            </button>
        </form>
    </div>
</div>
@endsection