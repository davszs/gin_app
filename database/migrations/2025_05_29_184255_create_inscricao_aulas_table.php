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
         Schema::create('inscricao_aula', function (Blueprint $table) {
            $table->id();
    $table->foreignId('aluno_id')->constrained('alunos');
    $table->foreignId('aula_id')->constrained('aulas');
    $table->string('status');
    $table->timestamp('data_inscricao');
    $table->timestamps(); // Isso adiciona created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscricao_aula');
    }
};
