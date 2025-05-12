<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Biblioteca de ícones -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href={{asset('css/login.css')}}>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main class="container">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <img class="logo" src="{{ asset('images/logo.png') }}">
            <h1>Área Exclusiva</h1>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

           

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">
                    Lembrar senha
                </label>
                <a href="{{ route('recuperar-senha') }}">Esqueci minha senha</a>
            </div>

            <button type="submit" class="login">Login</button>
        </form>
    </main>
</body>
</html>