<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->date('fecha');
            $table->integer('total_ventas')->default(0);
            $table->decimal('ingresos_totales', 10, 2)->default(0);
            $table->enum('tipo_reporte', ['ventas', 'inventario', 'empleados'])->default('ventas');
            $table->json('datos_adicionales')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
