<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::orderBy('id', 'desc')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'identidad'     => ['required', 'regex:/^[0-9]{13}$/', 'unique:empleados,identidad'],
            'nombre'        => ['required', 'string', 'max:255'],
            'apellido'      => ['required', 'string', 'max:255'],
            'correo'        => ['required', 'email', 'max:255'],
            'cargo'         => ['required', Rule::in(['Regente Farmacéutico', 'Asistente de Farmacia', 'Jefe de Bodega', 'Despachador', 'Cajero'])],
            'salario'       => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date'],
            'estado'        => ['required', Rule::in(['Activo', 'Inactivo'])],
        ], [
            'identidad.regex'  => 'La identidad (DNI) debe contener exactamente 13 dígitos numéricos sin guiones.',
            'identidad.unique' => 'Este número de identidad ya se encuentra registrado.',
            'salario.gt'       => 'El salario base debe ser mayor a 0 Lempiras.',
        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Colaborador registrado exitosamente en la nómina.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'identidad'     => ['required', 'regex:/^[0-9]{13}$/', Rule::unique('empleados', 'identidad')->ignore($empleado->id)],
            'nombre'        => ['required', 'string', 'max:255'],
            'apellido'      => ['required', 'string', 'max:255'],
            'correo'        => ['required', 'email', 'max:255'],
            'cargo'         => ['required', Rule::in(['Regente Farmacéutico', 'Asistente de Farmacia', 'Jefe de Bodega', 'Despachador', 'Cajero'])],
            'salario'       => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date'],
            'estado'        => ['required', Rule::in(['Activo', 'Inactivo'])],
        ], [
            'identidad.regex'  => 'La identidad (DNI) debe contener exactamente 13 dígitos numéricos sin guiones.',
            'identidad.unique' => 'Este número de identidad ya se encuentra registrado.',
            'salario.gt'       => 'El salario base debe ser mayor a 0 Lempiras.',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Datos del colaborador actualizados correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Colaborador eliminado de la nómina.');
    }
}