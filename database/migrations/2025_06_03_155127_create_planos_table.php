<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabela de planos
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->string('nome');
            $table->decimal('valor_total', 10, 2)->default(50);
            $table->string('status')->default('pendente'); // pendente, pago, cancelado
            $table->timestamps();
        });

        // Tabela pivot entre plano e inscrições
        Schema::create('plano_inscricao_aula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_id')->constrained('planos')->onDelete('cascade');
            $table->foreignId('inscricao_aula_id')->constrained('inscricao_aula')->onDelete('cascade');
            $table->timestamps();

            // Impede que uma mesma inscrição seja adicionada a mais de um plano (opcional)
            $table->unique(['plano_id', 'inscricao_aula_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plano_inscricao_aula');
        Schema::dropIfExists('planos');
    }
};
