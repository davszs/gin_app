<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Administrador</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <form action="{{route('admins.store')}}" method="POST">
        @csrf
            <main class="container">
            <h1>Novo Administrador</h1>

            <div class="input-box">
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" maxlength="50" required>
            </div>

            <div class="input-box">
                <label for="cpf">CPF:</label><br>
                <input type="text" name="cpf" id="cpf" maxlength="14" required>
            </div>

            <div class="input-box">
                <label for="email">Email:</label><br>
                <input type="email" name="email" maxlength="90" required>
            </div>
            
            <div class="input-box">
                <label for="telefone">Telefone (com DDD):</label><br>
                <input type="tel" name="telefone" id="telefone" maxlength="13" required>
            </div>
            <div class="input-box">
                <label for="endereco">Endereço:</label><br>
                <input type="text" name="endereco" maxlength="100">
            </div>
            <div>
                <input type="submit" class="login" value="Criar novo administrador">
            </div>
        </main>
    </form>
</body>

<script>
    const input = document.getElementById("cpf")
    
    input.addEventListener('keypress', () => {
        let inputlength = input.value.length

        if (inputlength === 3 || inputlength === 7) {
            input.value += '.'
        }else if(inputlength === 11){
            input.value += '-'
        }
    })
</script>
<script>
    const inputtel = document.getElementById("telefone")
    
    inputtel.addEventListener('keypress', () => {
        let inputlength = inputtel.value.length

        if (inputlength === 2) {
            inputtel.value += ' '
        }else if(inputlength === 8){
            inputtel.value += '-'
        }
    })
</script>

</html>