<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Layouts</title>
    
    
</head>
<body>
    @section('menu_adm')
    <div class="logo">
                <a href="#"><i class="fas fa-dumbbell"></i></a>
            </div>
    <ul class="sidebar-menu">
        <li class="sidebar-item active">
             <a href="#"><i class="fas fa-home"></i>
            <span>Início</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-user-graduate"></i>
            <span>Alunos</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-chalkboard-teacher"></i>
            <span>Professores</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-book"></i>
            <span>Aulas</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-users"></i>
            <span>Turmas</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-dollar-sign"></i>
            <span>Financeiro</span></a>
        </li>
        <li class="sidebar-item">
            <a href="#"> <i class="fas fa-cog"></i>
            <span>Configurações</span></a>
    </li>
        <li class="sidebar-item">
            <a href="#" id="logoutTrigger"><i class="fas fa-sign-out-alt"></i><span>Desconectar</span></a>
        </li>
    </ul>


    
    {{-- Modal de logout --}}
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

      @if (session('status'))
        <div class="overlay-message" id="overlayMessage">
            <div class="alert-box">
                <p>{{ session('status') }}</p>
                <button id="okBtn">OK</button>
            </div>
        </div>
        @endif
    </div>


    {{-- Scripts relacionados à sidebar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const okBtn = document.getElementById("okBtn");
            const overlay = document.getElementById("overlayMessage");
            if (okBtn && overlay) {
                okBtn.addEventListener("click", () => overlay.style.display = "none");
            }

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
        });
    </script>

@endsection

@section('menu_aluno')

            <div class="logo">
                <a href="#"><i class="fas fa-dumbbell"></i></a>
            </div>
            <ul class="nav-links">
                <li><a href="inicio.html" title="Início"><i class="fas fa-home"></i><span>Início</span></a></li>
                <li class="active"><a href="aulas.html" title="Aulas"><i
                            class="fas fa-calendar-alt"></i><span>Aulas</span></a></li>
                <li><a href="comunicados.html" title="Comunicados"><i
                            class="fas fa-bullhorn"></i><span>Comunicados</span></a></li>
                <li><a href="financeiro.html" title="Financeiro"><i
                            class="fas fa-wallet"></i><span>Financeiro</span></a></li>
                <li><a href="suporte.html" title="Suporte"><i class="fas fa-headset"></i><span>Suporte</span></a></li>
                <li class="sidebar-bottom">
                    <a href="configuracoes.html" title="Configurações"><i
                            class="fas fa-cog"></i><span>Configurações</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" id="logoutTrigger"><i class="fas fa-sign-out-alt"></        i><span>Desconectar</span></a>
                </li>
            </ul>


    
    {{-- Modal de logout --}}
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

      @if (session('status'))
        <div class="overlay-message" id="overlayMessage">
            <div class="alert-box">
                <p>{{ session('status') }}</p>
                <button id="okBtn">OK</button>
            </div>
        </div>
        @endif
    </div>


    {{-- Scripts relacionados à sidebar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const okBtn = document.getElementById("okBtn");
            const overlay = document.getElementById("overlayMessage");
            if (okBtn && overlay) {
                okBtn.addEventListener("click", () => overlay.style.display = "none");
            }

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
        });
    </script>

@endsection

    
</body>
</html>
