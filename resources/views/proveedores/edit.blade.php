@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Proveedor: {{ $proveedor->empresa }}</h1>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>RTN (14 dígitos) *</label>
                    <input type="text" name="rtn" maxlength="14" value="{{ old('rtn', $proveedor->rtn) }}"
                           class="form-control @error('rtn') is-invalid @enderror" required>
                    @error('rtn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-8">
                    <label>Empresa / Razón Social *</label>
                    <input type="text" name="empresa" value="{{ old('empresa', $proveedor->empresa) }}"
                           class="form-control @error('empresa') is-invalid @enderror" required>
                    @error('empresa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Contacto (Asesor Comercial) *</label>
                    <input type="text" name="contacto" value="{{ old('contacto', $proveedor->contacto) }}"
                           class="form-control @error('contacto') is-invalid @enderror" required>
                    @error('contacto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-3">
                    <label>Teléfono (8 dígitos) *</label>
                    <input type="text" name="telefono" maxlength="8" value="{{ old('telefono', $proveedor->telefono) }}"
                           class="form-control @error('telefono') is-invalid @enderror" required>
                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Categoría *</label>
                    <select name="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                        @foreach(['Fármacos', 'Material Quirúrgico', 'Equipos'] as $cat)
                            <option value="{{ $cat }}" {{ old('categoria', $proveedor->categoria) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Límite de Crédito (L.) *</label>
                    <input type="number" step="0.01" min="0" name="limite_credito" value="{{ old('limite_credito', $proveedor->limite_credito) }}"
                           class="form-control @error('limite_credito') is-invalid @enderror" required>
                    @error('limite_credito') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-3">
                    <label>Días de Crédito *</label>
                    <select name="dias_credito" class="form-control @error('dias_credito') is-invalid @enderror" required>
                        @foreach([15, 30, 45, 60] as $dias)
                            <option value="{{ $dias }}" {{ old('dias_credito', $proveedor->dias_credito) == $dias ? 'selected' : '' }}>{{ $dias }} días</option>
                        @endforeach
                    </select>
                    @error('dias_credito') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-3">
                    <label>Estado *</label>
                    <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado', $proveedor->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $proveedor->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-3">
                    <label>Fecha de Registro *</label>
                    <input type="date" name="fecha_registro" value="{{ old('fecha_registro', $proveedor->fecha_registro) }}"
                           class="form-control @error('fecha_registro') is-invalid @enderror" required>
                    @error('fecha_registro') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-sync-alt"></i> Actualizar Proveedor
            </button>
        </form>
    </div>
</div>
@endsection