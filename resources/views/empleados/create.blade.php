@extends('layouts.app')

@section('title', 'Registrar Colaborador')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Nuevo Colaborador</h1>
    <a href="{{ route('empleados.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Identidad / DNI (13 dígitos sin guiones) *</label>
                    <input type="text" name="identidad" maxlength="13" value="{{ old('identidad') }}" placeholder="0801200012345"
                           class="form-control @error('identidad') is-invalid @enderror" required>
                    @error('identidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Apellido *</label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}"
                           class="form-control @error('apellido') is-invalid @enderror" required>
                    @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Correo Electrónico *</label>
                    <input type="email" name="correo" value="{{ old('correo') }}" placeholder="colaborador@disfarma.hn"
                           class="form-control @error('correo') is-invalid @enderror" required>
                    @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Cargo *</label>
                    <select name="cargo" class="form-control @error('cargo') is-invalid @enderror" required>
                        <option value="">Seleccione un cargo...</option>
                        @foreach(['Regente Farmacéutico', 'Asistente de Farmacia', 'Jefe de Bodega', 'Despachador', 'Cajero'] as $cargo)
                            <option value="{{ $cargo }}" {{ old('cargo') == $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                        @endforeach
                    </select>
                    @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Salario Base Mensual (L.) *</label>
                    <input type="number" step="0.01" min="0.01" name="salario" value="{{ old('salario') }}"
                           class="form-control @error('salario') is-invalid @enderror" required>
                    @error('salario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fecha de Ingreso *</label>
                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', date('Y-m-d')) }}"
                           class="form-control @error('fecha_ingreso') is-invalid @enderror" required>
                    @error('fecha_ingreso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Estado *</label>
                    <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Guardar Colaborador
            </button>
        </form>
    </div>
</div>
@endsection