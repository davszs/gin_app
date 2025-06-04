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
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->tinyInteger('dia_semana'); // 1=Dom, ..., 7=Sáb
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->string('instrutor')->nullable();
            $table->integer('capacidade')->default(30);
            $table->decimal('valor', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
