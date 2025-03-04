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
        Schema::create('comprobantes', function (Blueprint $table) {
        $table->smallIncrements('id');
        $table->enum('tipo', ['boleta', 'factura']); // Define si es boleta o factura
        $table->string('numero')->unique(); // Número de la boleta o factura
        $table->date('fecha'); // Fecha de emisión
        $table->decimal('total', 10, 2); // Total de la venta
        $table->unsignedSmallInteger('ventas_id');
        $table->foreign('ventas_id')->references('id')->on('ventas')->onDelete('cascade');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
