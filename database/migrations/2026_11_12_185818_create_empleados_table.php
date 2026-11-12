<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('empleados', function (Blueprint $table) {
        $table->id();
        $table->string('identidad', 13)->unique();
        $table->string('nombre');
        $table->string('apellido');
        $table->string('correo');
        $table->enum('cargo', [
            'Regente Farmacéutico',
            'Asistente de Farmacia',
            'Jefe de Bodega',
            'Despachador',
            'Cajero'
        ]);
        $table->decimal('salario', 10, 2);
        $table->date('fecha_ingreso');
        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('empleados');
}
};
