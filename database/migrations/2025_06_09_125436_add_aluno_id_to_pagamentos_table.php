<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_add_aluno_id_to_pagamentos_table.php
public function up()
{
    Schema::table('pagamentos', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->after('plano_id');
        $table->foreign('user_id')->references('id')->on('alunos')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            //
        });
    }
};
