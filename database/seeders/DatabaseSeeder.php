<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
                 'status' => 'ativo',
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
                 'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nome' => 'Bloqueado Teste',
                'email' => 'bloqueia@teste.com',
                'email_verified_at' => now(),
                'password' => Hash::make('senha123'),
                'tipo' => 'aluno',
                 'cpf' => '12345678902',
                 'status' => 'bloqueado',
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
        DB::table('alunos')->insert([
            [
                'id' => 3,
                'user_id' => 3,
                'telefone' => '11999999799',
                'endereco' => 'Rua Exemplo, 321',
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
                'dia_semana' => 'Terça',
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
                'dia_semana' => 'Segunda',
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
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
         ]
]);
DB::table('planos')->insert([
        [
                'id' => 2,
                'aluno_id' => 3,
                'nome' => 'Plano Premium',
                'valor_total' => 0,
                'status' => 'cancelado',
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
        'user_id' => 1,
        'valor' => 50.00,
        'status' => 'pendente',
        'vencimento' => Carbon::parse('2025-06-25'),
        'data_referencia' => Carbon::parse('2025-06-01'),
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
DB::table('pagamentos')->insert([
    [
        'plano_id' => 1,
        'user_id' => 1,
        'valor' => 50.00,
        'status' => 'pago',
        'vencimento' => Carbon::parse('2025-05-25'),
        'data_referencia' => Carbon::parse('2025-05-01'),
        'data_pagamento' => Carbon::parse('2025-05-10'),
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

DB::table('comunicados')->insert([
            'titulo'     => 'Aula Extra de Funcional',
            'descricao'  => 'Na próxima quarta-feira teremos uma aula extra de treinamento funcional às 20h. Vagas limitadas!',
            'data'       => '2025-06-10',
            'tipo'       => 'aulas', // 'geral' ou 'aulas'
            'importante' => true,
        ]);
        
        // Users (4 a 13) com CPFs únicos
DB::table('users')->insert([
    [
        'id' => 4,
        'nome' => 'Gabriel Viana',
        'email' => 'oda-cruz@hotmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '59314682005', // Mantido o original
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'nome' => 'Caio Moura',
        'email' => 'azevedogustavo@yahoo.com.br',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '78092415676', // Mantido o original
        'status' => 'bloqueado',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 6,
        'nome' => 'Larissa Martins',
        'email' => 'larissa.martins@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '12345678909', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 7,
        'nome' => 'Rafael Souza',
        'email' => 'rafael.souza@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '23456789019', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 8,
        'nome' => 'Juliana Lima',
        'email' => 'juliana.lima@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '34567890129', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 9,
        'nome' => 'Marcos Oliveira',
        'email' => 'marcos.oliveira@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '45678901239', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 10,
        'nome' => 'Patricia Santos',
        'email' => 'patricia.santos@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '56789012349', // Alterado para ser único
        'status' => 'bloqueado',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 11,
        'nome' => 'Fernando Costa',
        'email' => 'fernando.costa@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '67890123459', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 12,
        'nome' => 'Amanda Rocha',
        'email' => 'amanda.rocha@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '78901234569', // Alterado para ser único
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 13,
        'nome' => 'Rodrigo Alves',
        'email' => 'rodrigo.alves@example.com',
        'email_verified_at' => now(),
        'password' => Hash::make('senha123'),
        'tipo' => 'aluno',
        'cpf' => '89012345679', // Alterado para ser único
        'status' => 'bloqueado',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
// Alunos (4 a 13)
DB::table('alunos')->insert([
    [
        'id' => 4,
        'user_id' => 4,
        'telefone' => '8431500823', // Padronizado sem formatação
        'endereco' => 'Alameda de da Paz, 64, Marçola, 99225713 Pinto / SC',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'user_id' => 5,
        'telefone' => '819089358', // Padronizado sem formatação
        'endereco' => 'Parque Mirella Aragão, 9, Custodinha, 36904865 Cardoso / RR',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 6,
        'user_id' => 6,
        'telefone' => '11987654321',
        'endereco' => 'Rua das Flores, 123, Centro, 01001000 São Paulo / SP',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 7,
        'user_id' => 7,
        'telefone' => '21998765432',
        'endereco' => 'Avenida Brasil, 456, Copacabana, 22021000 Rio de Janeiro / RJ',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 8,
        'user_id' => 8,
        'telefone' => '31987651234',
        'endereco' => 'Rua da Paz, 789, Savassi, 30140000 Belo Horizonte / MG',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 9,
        'user_id' => 9,
        'telefone' => '41998764321',
        'endereco' => 'Avenida Sete de Setembro, 1010, Centro, 80010000 Curitiba / PR',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 10,
        'user_id' => 10,
        'telefone' => '51987658765',
        'endereco' => 'Rua dos Andradas, 2020, Centro Histórico, 90020000 Porto Alegre / RS',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 11,
        'user_id' => 11,
        'telefone' => '61998769876',
        'endereco' => 'Quadra 302, Conjunto 05, 70610200 Brasília / DF',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 12,
        'user_id' => 12,
        'telefone' => '71987653456',
        'endereco' => 'Avenida Tancredo Neves, 3030, Caminho das Árvores, 41820000 Salvador / BA',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 13,
        'user_id' => 13,
        'telefone' => '81998766543',
        'endereco' => 'Rua do Futuro, 4040, Boa Viagem, 51021000 Recife / PE',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Planos (4 a 13)
DB::table('planos')->insert([
    [
        'id' => 4,
        'aluno_id' => 4,
        'nome' => 'Trimestral',
        'valor_total' => 150.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'aluno_id' => 5,
        'nome' => 'Mensal',
        'valor_total' => 150.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 6,
        'aluno_id' => 6,
        'nome' => 'Semestral',
        'valor_total' => 250.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 7,
        'aluno_id' => 7,
        'nome' => 'Mensal',
        'valor_total' => 100.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 8,
        'aluno_id' => 8,
        'nome' => 'Trimestral',
        'valor_total' => 200.00,
        'status' => 'cancelado',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 9,
        'aluno_id' => 9,
        'nome' => 'Anual',
        'valor_total' => 400.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 10,
        'aluno_id' => 10,
        'nome' => 'Mensal',
        'valor_total' => 120.00,
        'status' => 'cancelado',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 11,
        'aluno_id' => 11,
        'nome' => 'Trimestral',
        'valor_total' => 180.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 12,
        'aluno_id' => 12,
        'nome' => 'Semestral',
        'valor_total' => 300.00,
        'status' => 'ativo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 13,
        'aluno_id' => 13,
        'nome' => 'Mensal',
        'valor_total' => 90.00,
        'status' => 'cancelado',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Pagamentos (exemplos para vários planos)
DB::table('pagamentos')->insert([
    // Pagamentos para plano 4
    [
        'plano_id' => 4,
        'user_id' => 4,
        'valor' => 50.00,
        'status' => 'pago',
        'vencimento' => '2025-02-01',
        'data_referencia' => '2025-01-01',
        'data_pagamento' => '2025-02-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 4,
        'user_id' => 4,
        'valor' => 50.00,
        'status' => 'pago',
        'vencimento' => '2025-03-01',
        'data_referencia' => '2025-02-01',
        'data_pagamento' => '2025-03-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 4,
        'user_id' => 4,
        'valor' => 50.00,
        'status' => 'pago',
        'vencimento' => '2025-04-01',
        'data_referencia' => '2025-03-01',
        'data_pagamento' => '2025-04-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 4,
        'user_id' => 4,
        'valor' => 50.00,
        'status' => 'pendente',
        'vencimento' => '2025-05-01',
        'data_referencia' => '2025-04-01',
        'data_pagamento' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Pagamentos para plano 5
    [
        'plano_id' => 5,
        'user_id' => 5,
        'valor' => 150.00,
        'status' => 'pago',
        'vencimento' => '2025-04-01',
        'data_referencia' => '2025-04-01',
        'data_pagamento' => '2025-04-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 5,
        'user_id' => 5,
        'valor' => 150.00,
        'status' => 'vencido',
        'vencimento' => '2025-05-01',
        'data_referencia' => '2025-05-01',
        'data_pagamento' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Pagamentos para plano 6
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pago',
        'vencimento' => '2025-01-01',
        'data_referencia' => '2025-01-01',
        'data_pagamento' => '2025-01-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pago',
        'vencimento' => '2025-02-01',
        'data_referencia' => '2025-02-01',
        'data_pagamento' => '2025-02-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pago',
        'vencimento' => '2025-03-01',
        'data_referencia' => '2025-03-01',
        'data_pagamento' => '2025-03-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pago',
        'vencimento' => '2025-04-01',
        'data_referencia' => '2025-04-01',
        'data_pagamento' => '2025-04-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pago',
        'vencimento' => '2025-05-01',
        'data_referencia' => '2025-05-01',
        'data_pagamento' => '2025-05-01',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'user_id' => 6,
        'valor' => 41.67,
        'status' => 'pendente',
        'vencimento' => '2025-06-01',
        'data_referencia' => '2025-06-01',
        'data_pagamento' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Pagamento para plano 7
    [
        'plano_id' => 7,
        'user_id' => 7,
        'valor' => 100.00,
        'status' => 'pago',
        'vencimento' => '2025-05-01',
        'data_referencia' => '2025-05-01',
        'data_pagamento' => '2025-05-01',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Aulas (3 a 12)
DB::table('aulas')->insert([
    [
        'id' => 3,
        'nome' => 'Amet Fit',
        'descricao' => 'Quod odio reiciendis ipsam.',
        'dia_semana' => 'Sexta',
        'horario_inicio' => '07:00:00',
        'horario_fim' => '08:00:00',
        'instrutor' => 'Nathan Moura',
        'valor' => 50.00,
        'capacidade' => 20,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 4,
        'nome' => 'Maxime Fit',
        'descricao' => 'In nihil dolorem adipisci blanditiis perferendis.',
        'dia_semana' => 'Sexta',
        'horario_inicio' => '07:00:00',
        'horario_fim' => '08:00:00',
        'instrutor' => 'Ana Beatriz Costela',
        'valor' => 50.00,
        'capacidade' => 20,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'nome' => 'Yoga Matinal',
        'descricao' => 'Aula de yoga para iniciantes com foco em alongamento e relaxamento.',
        'dia_semana' => 'Segunda',
        'horario_inicio' => '06:00:00',
        'horario_fim' => '07:00:00',
        'instrutor' => 'Carlos Silva',
        'valor' => 60.00,
        'capacidade' => 15,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 6,
        'nome' => 'HIIT Avançado',
        'descricao' => 'Treino intervalado de alta intensidade para alunos avançados.',
        'dia_semana' => 'Terça',
        'horario_inicio' => '18:00:00',
        'horario_fim' => '19:00:00',
        'instrutor' => 'Mariana Oliveira',
        'valor' => 70.00,
        'capacidade' => 10,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 7,
        'nome' => 'Pilates Reformer',
        'descricao' => 'Aula de pilates com equipamentos para fortalecimento do core.',
        'dia_semana' => 'Quarta',
        'horario_inicio' => '09:00:00',
        'horario_fim' => '10:00:00',
        'instrutor' => 'Fernanda Costa',
        'valor' => 80.00,
        'capacidade' => 8,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 8,
        'nome' => 'Zumba Fitness',
        'descricao' => 'Aula de dança divertida para queimar calorias.',
        'dia_semana' => 'Quinta',
        'horario_inicio' => '19:00:00',
        'horario_fim' => '20:00:00',
        'instrutor' => 'Ricardo Santos',
        'valor' => 55.00,
        'capacidade' => 25,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 9,
        'nome' => 'Musculação Orientada',
        'descricao' => 'Treino de musculação com acompanhamento personalizado.',
        'dia_semana' => 'Sexta',
        'horario_inicio' => '17:00:00',
        'horario_fim' => '18:00:00',
        'instrutor' => 'Rodrigo Almeida',
        'valor' => 65.00,
        'capacidade' => 12,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 10,
        'nome' => 'Alongamento e Flexibilidade',
        'descricao' => 'Exercícios para melhorar flexibilidade e prevenir lesões.',
        'dia_semana' => 'Sábado',
        'horario_inicio' => '08:00:00',
        'horario_fim' => '09:00:00',
        'instrutor' => 'Patrícia Lima',
        'valor' => 45.00,
        'capacidade' => 15,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 11,
        'nome' => 'Boxe Fitness',
        'descricao' => 'Aula de boxe para condicionamento físico e defesa pessoal.',
        'dia_semana' => 'Segunda',
        'horario_inicio' => '19:00:00',
        'horario_fim' => '20:00:00',
        'instrutor' => 'Bruno Carvalho',
        'valor' => 75.00,
        'capacidade' => 10,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 12,
        'nome' => 'Funcional ao Ar Livre',
        'descricao' => 'Treino funcional realizado em área externa.',
        'dia_semana' => 'Sábado',
        'horario_inicio' => '07:30:00',
        'horario_fim' => '08:30:00',
        'instrutor' => 'Juliana Rocha',
        'valor' => 60.00,
        'capacidade' => 20,
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Inscrições em aulas (exemplos para vários alunos)
DB::table('inscricao_aula')->insert([
    // Aluno 4 (continuação)
    [
        'id' => 4,
        'aluno_id' => 4,
        'aula_id' => 5,
        'status' => 'ativo',
        'valor' => 60.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'aluno_id' => 4,
        'aula_id' => 8,
        'status' => 'inativo',
        'valor' => 55.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 5
    [
        'id' => 6,
        'aluno_id' => 5,
        'aula_id' => 6,
        'status' => 'ativo',
        'valor' => 70.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 6
    [
        'id' => 7,
        'aluno_id' => 6,
        'aula_id' => 7,
        'status' => 'ativo',
        'valor' => 80.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 8,
        'aluno_id' => 6,
        'aula_id' => 10,
        'status' => 'ativo',
        'valor' => 45.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 7
    [
        'id' => 9,
        'aluno_id' => 7,
        'aula_id' => 9,
        'status' => 'ativo',
        'valor' => 65.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 8
    [
        'id' => 10,
        'aluno_id' => 8,
        'aula_id' => 11,
        'status' => 'ativo',
        'valor' => 75.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 9
    [
        'id' => 11,
        'aluno_id' => 9,
        'aula_id' => 12,
        'status' => 'ativo',
        'valor' => 60.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 12,
        'aluno_id' => 9,
        'aula_id' => 5,
        'status' => 'ativo',
        'valor' => 60.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Aluno 10
    [
        'id' => 13,
        'aluno_id' => 10,
        'aula_id' => 8,
        'status' => 'bloqueado',
        'valor' => 55.00,
        'data_inscricao' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Vínculos entre planos e inscrições em aulas
DB::table('plano_inscricao_aula')->insert([
    // Plano 4 (continuação)
    [
        'plano_id' => 4,
        'inscricao_aula_id' => 4,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 4,
        'inscricao_aula_id' => 5,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 5
    [
        'plano_id' => 5,
        'inscricao_aula_id' => 6,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 6
    [
        'plano_id' => 6,
        'inscricao_aula_id' => 7,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 6,
        'inscricao_aula_id' => 8,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 7
    [
        'plano_id' => 7,
        'inscricao_aula_id' => 9,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 8
    [
        'plano_id' => 8,
        'inscricao_aula_id' => 10,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 9
    [
        'plano_id' => 9,
        'inscricao_aula_id' => 11,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'plano_id' => 9,
        'inscricao_aula_id' => 12,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    
    // Plano 10
    [
        'plano_id' => 10,
        'inscricao_aula_id' => 13,
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
    }

    
}
