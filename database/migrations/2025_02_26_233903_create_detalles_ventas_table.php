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
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);

            $table->unsignedSmallInteger('ventas_id');
            $table->unsignedSmallInteger('productos_id');

            $table->foreign('ventas_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_ventas');
    }
};
