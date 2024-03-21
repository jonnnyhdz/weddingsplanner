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
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_oportunidad', 45);
            $table->decimal('monto', 4, 2);
            $table->date('fecha_cierre');
            $table->tinyInteger('status')->default(0);
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('prospecto_id');
            $table->foreign('prospecto_id')->references('id')->on('prospectos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oportunidades');
    }
};