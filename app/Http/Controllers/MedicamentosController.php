<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MedicamentosController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $medicamentos = Medicamentos::when($busqueda, function ($query, $busqueda) {
                $query->where('nombre', 'like', "%{$busqueda}%")
                      ->orWhere('codigo', 'like', "%{$busqueda}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString(); // Mantiene el filtro de búsqueda al cambiar de página

        return view('medicamentos.index', compact('medicamentos', 'busqueda'));
    }

    public function create()
    {
        return view('medicamentos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo'            => ['required', 'string', 'max:50', 'unique:medicamentos,codigo'],
            'nombre'            => ['required', 'string', 'max:255'],
            'categoria'         => ['required', Rule::in(['Antibióticos', 'Analgésicos', 'Sueros', 'Material Quirúrgico', 'Vitaminas'])],
            'precio'            => ['required', 'numeric', 'gt:0'],
            'costo'             => ['required', 'numeric', 'min:0'],
            'inventario'        => ['required', 'integer', 'min:0'],
            'laboratorio'       => ['required', 'string', 'max:255'],
            'fecha_vencimiento' => ['required', 'date'],
            'fecha_registro'    => ['required', 'date'],
            'numero_lote'       => ['required', 'string', 'max:100'],
            'imagen'            => ['nullable', 'image', 'mimes:jpg,png,webp', 'max:5120'], // Máx 5MB (5120 KB)
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/medicamentos'), $filename);
            $validated['imagen'] = 'uploads/medicamentos/' . $filename;
        }

        Medicamentos::create($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento registrado correctamente.');
    }

    public function edit(Medicamentos $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    public function update(Request $request, Medicamentos $medicamento)
    {
        $validated = $request->validate([
            'codigo'            => ['required', 'string', 'max:50', Rule::unique('medicamentos', 'codigo')->ignore($medicamento->id)],
            'nombre'            => ['required', 'string', 'max:255'],
            'categoria'         => ['required', Rule::in(['Antibióticos', 'Analgésicos', 'Sueros', 'Material Quirúrgico', 'Vitaminas'])],
            'precio'            => ['required', 'numeric', 'gt:0'],
            'costo'             => ['required', 'numeric', 'min:0'],
            'inventario'        => ['required', 'integer', 'min:0'],
            'laboratorio'       => ['required', 'string', 'max:255'],
            'fecha_vencimiento' => ['required', 'date'],
            'fecha_registro'    => ['required', 'date'],
            'numero_lote'       => ['required', 'string', 'max:100'],
            'imagen'            => ['nullable', 'image', 'mimes:jpg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($medicamento->imagen && File::exists(public_path($medicamento->imagen))) {
                File::delete(public_path($medicamento->imagen));
            }

            $file = $request->file('imagen');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/medicamentos'), $filename);
            $validated['imagen'] = 'uploads/medicamentos/' . $filename;
        }

        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamentos $medicamento)
    {
        if ($medicamento->imagen && File::exists(public_path($medicamento->imagen))) {
            File::delete(public_path($medicamento->imagen));
        }

        $medicamento->delete();

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento eliminado del inventario.');
    }
}