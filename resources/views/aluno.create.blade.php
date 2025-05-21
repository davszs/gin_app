<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Aluno</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <form action="{{route('alunos/store')}}" method="POST">
        @csrf
            <main class="container">
            <h1>Novo Aluno</h1>

            <div class="input-box">
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" maxlength="50" required>
            </div>

            <div class="input-box">
                <label for="cpf">CPF (apenas números):</label><br>
                <input type="text" name="cpf" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})" 
                maxlength="11">
            </div>

            <div class="input-box">
                <label for="email">Email:</label><br>
                <input type="email" name="email" required>
            </div>
            
            <div class="input-box">
                <label for="telefone">Telefone (com DDD):</label><br>
                <input type="tel" name="telefone" maxlength="11">
            </div>
            <div>
                <input type="submit" class="login" value="Criar novo aluno">
            </div>
        </main>
    </form>
</body>
</html>