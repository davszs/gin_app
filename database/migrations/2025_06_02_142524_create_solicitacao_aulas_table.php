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
        Schema::create('solicitacao_aulas', function (Blueprint $table) {
           $table->id();
    $table->unsignedBigInteger('aluno_id');
    $table->unsignedBigInteger('aula_id');
    $table->string('tipo');
    $table->string('status')->default('pendente');
    $table->timestamps();

    $table->foreign('aluno_id', 'fk_solicitacao_aluno_id')
        ->references('id')->on('alunos')
        ->onDelete('cascade');

    $table->foreign('aula_id', 'fk_solicitacao_aula_id')
        ->references('id')->on('aulas')
        ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_aulas');
    }
};
