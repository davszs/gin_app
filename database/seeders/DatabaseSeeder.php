<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Inserindo usuários (aluno e adm)
        DB::table('users')->insert([
            [
                'id' => 1,
                'nome' => 'Aluno Teste',
                'email' => 'aluno@teste.com',
                'email_verified_at' => now(),
                'password' => Hash::make('aluno123'),  // senha que quiser
                'tipo' => 'aluno',
                 'cpf' => '22222222222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nome' => 'Administrador',
                'email' => 'admin@teste.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'tipo' => 'administrador',
                 'cpf' => '12345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Inserindo aluno vinculado ao usuário 1
        DB::table('alunos')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'telefone' => '11999999999',
                'endereco' => 'Rua Exemplo, 123',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Inserindo aula
        DB::table('aulas')->insert([
            [
                'id' => 1,
                'nome' => 'Crossfit',
                'descricao' => 'Aula de Crossfit com foco em glúteo, com instrutor Eduardo dos Reis.',
                'dia_semana' => 1,
                'horario_inicio' => '07:00:00',
                'horario_fim' => '08:00:00',
                'instrutor' => 'Eduardo dos Reis',
                'valor' => 50.00,
                'capacidade' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('aulas')->insert([
            [
                'id' => 2,
                'nome' => 'Funcional Nádegas',
                'descricao' => 'Levantamento de peso com nádegas, com Gabriel Minelli',
                'dia_semana' => 1,
                'horario_inicio' => '07:00:00',
                'horario_fim' => '08:00:00',
                'instrutor' => 'Gabriel Minelli',
                'valor' => 50.00,
                'capacidade' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Inserindo inscrição da aula para o aluno
        DB::table('inscricao_aula')->insert([
            [
                'id' => 1,
                'aluno_id' => 1,
                'aula_id' => 1,
                'status' => 'ativo',
                'valor' => 50.00,
                'data_inscricao' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Inserindo plano para o aluno
        DB::table('planos')->insert([
        [
                'id' => 1,
                'aluno_id' => 1,
                'nome' => 'Plano Inicial',
                'valor_total' => 50.00,
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
         ]
]);

// Ligando a inscrição ao plano
DB::table('plano_inscricao_aula')->insert([
    [
        'plano_id' => 1,
        'inscricao_aula_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

DB::table('pagamentos')->insert([
    [
        'plano_id' => 1,
        'valor' => 50.00,
        'status' => 'pendente',
        'vencimento' => now()->addDays(7),
        'data_referencia' => now()->startOfMonth(),
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
    }

    
}
