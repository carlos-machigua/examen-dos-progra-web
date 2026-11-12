@extends('layouts.app')

@section('title', 'Dashboard Gerencial - DISFARMA')

@section('content')
<!-- Encabezado -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Gerencial</h1>
</div>

<!-- Fila de 4 Tarjetas KPI -->
<div class="row">

    <!-- KPI 1: Total de Medicamentos en Catálogo -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Medicamentos en Catálogo
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($totalMedicamentos) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pills fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 2: Total de Proveedores Activos -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Proveedores Activos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($proveedoresActivos) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-truck fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 3: Total de Empleados en Nómina -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Empleados en Nómina
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($totalEmpleados) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-nurse fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 4: Valor Total del Inventario en Lempiras -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Valor Total Inventario
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            L. {{ number_format($valorInventario ?? 0, 2, '.', ',') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-coins fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Accesos rápidos a los módulos -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Accesos Directos del Sistema</h6>
            </div>
            <div class="card-body">
                <p class="mb-3">Selecciona un módulo para gestionar los registros de DISFARMA Honduras:</p>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-primary btn-sm mr-2 mb-2">
                    <i class="fas fa-pills mr-1"></i> Gestionar Medicamentos
                </a>
                <a href="{{ route('proveedores.index') }}" class="btn btn-success btn-sm mr-2 mb-2">
                    <i class="fas fa-truck mr-1"></i> Gestionar Proveedores
                </a>
                <a href="{{ route('empleados.index') }}" class="btn btn-info btn-sm mb-2">
                    <i class="fas fa-user-nurse mr-1"></i> Gestionar Personal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection