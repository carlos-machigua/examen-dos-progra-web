@extends('layouts.app')

@section('title', 'Registrar Medicamento')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Nuevo Medicamento</h1>
    <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left fa-sm"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('medicamentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Código (SKU) *</label>
                    <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" required>
                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-8">
                    <label>Nombre del Medicamento *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Categoría *</label>
                    <select name="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                        <option value="">Seleccione...</option>
                        @foreach(['Antibióticos', 'Analgésicos', 'Sueros', 'Material Quirúrgico', 'Vitaminas'] as $cat)
                            <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Laboratorio *</label>
                    <input type="text" name="laboratorio" value="{{ old('laboratorio') }}" class="form-control @error('laboratorio') is-invalid @enderror" required>
                    @error('laboratorio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Número de Lote *</label>
                    <input type="text" name="numero_lote" value="{{ old('numero_lote') }}" class="form-control @error('numero_lote') is-invalid @enderror" required>
                    @error('numero_lote') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Precio de Venta (L.) *</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" class="form-control @error('precio') is-invalid @enderror" required>
                    @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Costo (L.) *</label>
                    <input type="number" step="0.01" name="costo" value="{{ old('costo') }}" class="form-control @error('costo') is-invalid @enderror" required>
                    @error('costo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Inventario (Stock) *</label>
                    <input type="number" name="inventario" value="{{ old('inventario', 0) }}" class="form-control @error('inventario') is-invalid @enderror" required>
                    @error('inventario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fecha de Vencimiento *</label>
                    <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" class="form-control @error('fecha_vencimiento') is-invalid @enderror" required>
                    @error('fecha_vencimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Fecha de Registro *</label>
                    <input type="date" name="fecha_registro" value="{{ old('fecha_registro', date('Y-m-d')) }}" class="form-control @error('fecha_registro') is-invalid @enderror" required>
                    @error('fecha_registro') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    <label>Fotografía del Empaque (JPG, PNG, WEBP - Máx 5MB)</label>
                    <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp" class="form-control-file @error('imagen') is-invalid @enderror">
                    @error('imagen') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Guardar Medicamento
            </button>
        </form>
    </div>
</div>
@endsection