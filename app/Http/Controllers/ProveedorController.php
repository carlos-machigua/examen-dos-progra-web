<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'desc')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rtn'            => ['required', 'regex:/^[0-9]{14}$/', 'unique:proveedores,rtn'],
            'empresa'        => ['required', 'string', 'max:255'],
            'contacto'       => ['required', 'string', 'max:255'],
            'telefono'       => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria'      => ['required', Rule::in(['Fármacos', 'Material Quirúrgico', 'Equipos'])],
            'limite_credito' => ['required', 'numeric', 'min:0'],
            'dias_credito'   => ['required', 'integer', Rule::in([15, 30, 45, 60])],
            'estado'         => ['required', Rule::in(['Activo', 'Inactivo'])],
            'fecha_registro' => ['required', 'date'],
        ], [
            'rtn.regex'      => 'El RTN debe contener exactamente 14 dígitos numéricos.',
            'rtn.unique'     => 'Este RTN ya está registrado con otro proveedor.',
            'telefono.regex' => 'El teléfono debe tener 8 dígitos e iniciar con 2, 3, 8 o 9.',
        ]);

        Proveedor::create($validated);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor registrado exitosamente.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'rtn'            => ['required', 'regex:/^[0-9]{14}$/', Rule::unique('proveedores', 'rtn')->ignore($proveedor->id)],
            'empresa'        => ['required', 'string', 'max:255'],
            'contacto'       => ['required', 'string', 'max:255'],
            'telefono'       => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria'      => ['required', Rule::in(['Fármacos', 'Material Quirúrgico', 'Equipos'])],
            'limite_credito' => ['required', 'numeric', 'min:0'],
            'dias_credito'   => ['required', 'integer', Rule::in([15, 30, 45, 60])],
            'estado'         => ['required', Rule::in(['Activo', 'Inactivo'])],
            'fecha_registro' => ['required', 'date'],
        ], [
            'rtn.regex'      => 'El RTN debe contener exactamente 14 dígitos numéricos.',
            'rtn.unique'     => 'Este RTN ya está registrado con otro proveedor.',
            'telefono.regex' => 'El teléfono debe tener 8 dígitos e iniciar con 2, 3, 8 o 9.',
        ]);

        $proveedor->update($validated);

        return redirect()->route('proveedores.index')
            ->with('success', 'Datos del proveedor actualizados correctamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado del sistema.');
    }
}