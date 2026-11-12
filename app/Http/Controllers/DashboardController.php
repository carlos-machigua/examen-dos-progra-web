<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Medicamentos;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMedicamentos = Medicamentos::count();

        $proveedoresActivos = Proveedor::where('estado', 'Activo')->count();

        $totalEmpleados = Empleado::count();

        $valorInventario = Medicamentos::sum(DB::raw('inventario * precio'));

        return view('dashboard', compact(
            'totalMedicamentos',
            'proveedoresActivos',
            'totalEmpleados',
            'valorInventario'
        ));
    }
}