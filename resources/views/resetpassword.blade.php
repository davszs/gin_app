<!DOCTYPE html>
<html lang="pt-br">
<head>
<!-- Google Fonts Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Biblioteca de icones design -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="{{asset('css/login.css')}}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <main class="container">
        <form action="{{ route('recuperar-senha') }}" method="POST" id="recuperar-form">
            @csrf
            <h1>Recuperar Senha</h1>
            <p>Informe o seu e-mail para que possamos enviar as instruções de recuperação.</p>

            <div class="input-box">
                <input type="email" name="email" placeholder="Digite seu e-mail" required>
                <i class="bx bxs-envelope"></i>
            </div>

            <button onclick="msg()" type="submit" class="login">Enviar Instruções</button>
            
<br><br>
            <p class="back-to-login" >
                <a href="{{ route('login') }}">Voltar para o login</a>
            </p>
        </form>
    </main>
@if (session('status'))
    <div class="message" id="messageBox">
        <p>{{ session('status') }}</p>
        <button id="closeBtn">OK</button>
    </div>
@endif

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const closeBtn = document.getElementById("closeBtn");
        const msgBox = document.getElementById("messageBox");

        if (closeBtn && msgBox) {
            closeBtn.addEventListener("click", () => {
                msgBox.style.display = "none";
            });
        }
    });
</script>
    <script src="{{ asset('js/script.js')}}"></script>
</body>
</html>