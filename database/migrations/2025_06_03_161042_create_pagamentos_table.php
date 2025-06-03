<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_id')->constrained('planos')->onDelete('cascade');
            $table->date('data_referencia'); // mês de referência do pagamento (ex: 2025-06-01)
            $table->date('vencimento');
            $table->decimal('valor', 10, 2);
            $table->enum('status', ['pendente', 'pago', 'vencido'])->default('pendente');
            $table->timestamp('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
