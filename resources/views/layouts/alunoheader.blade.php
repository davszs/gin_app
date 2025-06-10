<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Portal do Aluno')</title>

    {{-- Token CSRF para JS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}" />
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    @stack('styles')
</head>

<body>

    {{-- Sidebar --}}
    <nav class="sidebar">
        <div class="logo">
            <a href="{{ route('aluno.dashboard') }}"><img src="/images/favicon.ico" alt=""></a>
        </div>
        <ul class="nav-links">
            <li class="{{ request()->routeIs('aluno.dashboard') ? 'active' : '' }}">
                <a href="{{ route('aluno.dashboard') }}" title="Início"><i class="fas fa-home"></i><span>Início</span></a>
            </li>
            <li class="{{ request()->routeIs('aulas.aluno') ? 'active' : '' }}">
                <a href="{{ route('aulas.aluno') }}" title="Aulas"><i class="fas fa-calendar-alt"></i><span>Aulas</span></a>
            </li>
            <li class="{{ request()->routeIs('comunicados.aluno') ? 'active' : '' }}">
                <a href="{{ route('comunicados.aluno') }}" title="Comunicados"><i class="fas fa-bullhorn"></i><span>Comunicados</span></a>
            </li>
            <li class="{{ request()->routeIs('pagamento.aluno') ? 'active' : '' }}">
                <a href="{{ route('pagamento.aluno') }}" title="Financeiro"><i class="fas fa-wallet"></i><span>Mensalidades</span></a>
            </li>
            <li class="{{ request()->routeIs('suport.aluno') ? 'active' : '' }}"><a href="{{ route('suport.aluno') }}" title="Suporte"><i class="fas fa-headset"></i><span>Suporte</span></a></li>
            <li class="{{ request()->routeIs('config.aluno') ? 'active' : '' }}">
                <a href="{{ route('config.aluno') }}" title="Configurações"><i class="fas fa-cog"></i><span>Configurações</span></a>
            </li>
            <li><a href="#" id="logoutTrigger"><i class="fas fa-sign-out-alt"></i><span>Desconectar</span></a></li>
        </ul>
    </nav>

    {{-- Modal Logout --}}
    <div id="logoutModal" class="logout-overlay" style="display: none;">
        <div class="logout-box">
            <p>Tem certeza que deseja desconectar a conta e sair?</p>
            <div class="logout-buttons">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm">Sim, sair</button>
                </form>
                <button class="cancel" id="cancelLogout">Cancelar</button>
            </div>
        </div>
    </div>

    {{-- Mensagem de status --}}
    @if(session('status'))
    <div class="overlay-message" id="overlayMessage">
        <div class="alert-box">
            <p>{{ session('status') }}</p>
            <button id="okBtn">OK</button>
        </div>
    </div>
    @endif

    {{-- Conteúdo principal --}}
    <div class="container">
        <main class="content">
            <header class="top-bar">
                <div class="page-title">
                    <h1>@yield('page-title', 'Página')</h1>
                </div>
                <div class="user-info">
                    <span>Logado como <strong>Aluno</strong></span>
                    <div class="user-avatar">
                       <img src="{{ asset('storage/' . (auth()->user()->aluno->avatar ?? 'default-avatar.png')) }}" />

                    </div>
                </div>
            </header>

            <div class="dashboard-container">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Scripts --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fechar mensagem de status
            const okBtn = document.getElementById("okBtn");
            const overlay = document.getElementById("overlayMessage");
            if (okBtn && overlay) {
                okBtn.addEventListener("click", () => overlay.style.display = "none");
            }

            // Modal logout
            const logoutLink = document.getElementById("logoutTrigger");
            const logoutModal = document.getElementById("logoutModal");
            const cancelBtn = document.getElementById("cancelLogout");

            logoutLink?.addEventListener("click", e => {
                e.preventDefault();
                logoutModal.style.display = "flex";
            });

            cancelBtn?.addEventListener("click", () => {
                logoutModal.style.display = "none";
            });

            // Menu toggle mobile
            if (window.innerWidth <= 768) {
                const topBar = document.querySelector('.top-bar');
                const sidebar = document.querySelector('.sidebar');

                if (!document.querySelector('.menu-toggle')) {
                    const menuToggle = document.createElement('button');
                    menuToggle.className = 'menu-toggle';
                    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    topBar.insertBefore(menuToggle, topBar.firstChild);

                    menuToggle.addEventListener('click', () => {
                        sidebar.classList.toggle('active');
                    });
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
