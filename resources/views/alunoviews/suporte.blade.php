@extends('layouts.alunoheader')

@section('title', 'Suporte')
@section('page-title', 'Suporte')

@section('content')
<h3>Dúvidas? <br>Abre um Chamado</h3>
<!-- Botão flutuante para abrir o formulário -->
<button id="btnAbrirChamado" class="btn-flutuante">
    + Novo chamado
</button>

<!-- Modal com o formulário -->
<div id="modalChamado" class="modal">
    <div class="modal-content">
        <span class="fechar" onclick="fecharModal()">&times;</span>

        <!-- Aqui vai o formulário -->
        <form action="{{ route('suporte.enviar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2><i class="fas fa-plus-circle"></i><strong>  Novo chamado</strong></h2><br>

            <div class="mb-3">
                <label for="email">Seu E-mail: </label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div><br>

            <div class="mb-3">
                <label for="tipo">Tipo de Problema: </label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">Selecione um tipo</option>
                    <option value="erro_login">Erro ao fazer login</option>
                    <option value="problema_pagina">Problema com a página</option>
                    <option value="duvida_funcionalidade">Dúvida sobre funcionalidade</option>
                    <option value="outros">Outros</option>
                </select>
            </div><br>

            <div class="mb-3">
                <label for="descricao">Descrição do Problema</label><br>
                <textarea name="descricao" id="descricao" class="form-controls" rows="4" placeholder="Descreva o problema..." required></textarea>
            </div><br>
<div class="mb-3">
    <label for="anexo"><i class="fas fa-paperclip"></i> Anexar imagem do problema (opcional)</label><br>
    <input type="file" name="anexo" id="anexo" accept="image/*" class="form-control-file">
</div><br>
            <button type="submit" class="btn btn-primary">Enviar Chamado</button>
        </form>
    </div>
</div>

<!-- Contato e Localização -->
<div class="contato-container">
    <div class="contato-info">
        <h4><i class="fas fa-map-marker-alt"></i> Localização do Escritório</h4>
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.2508459634128!2d-46.691896625416184!3d-23.702734566799823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9be46d5222a8f7%3A0xd0a91a78f6212c68!2sEtec%20Irm%C3%A3%20Agostina!5e0!3m2!1spt-BR!2sbr!4v1749496217604!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="contato-info">
        <h4><i class="fas fa-envelope"></i> E-mail</h4>
        <p>suporte@academiaexemplo.com</p>

        <h4><i class="fab fa-whatsapp"></i> WhatsApp</h4>
        <p><a href="https://wa.me/5599999999999" target="_blank">(11) 94701-5576</a></p>
    </div>
</div>

@if(session('success'))
<div id="successBox" class="alert-box">
    <div class="alert-content">
        <p>{{ session('success') }}</p>
        <button onclick="document.getElementById('successBox').style.display='none'">OK</button>
    </div>
</div>
@endif

<script>
    const modal = document.getElementById('modalChamado');
    const btn = document.getElementById('btnAbrirChamado');

    btn.onclick = function () {
        modal.classList.add('aberto');
    }

    function fecharModal() {
        modal.classList.remove('aberto');
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.classList.remove('aberto');
        }
    }
</script>



@endsection

<style>
    body {
        background-color: #f9f9fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h3 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-box {
    position: fixed;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #e0f7e9;
    color: #2e7d32;
    padding: 20px 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    z-index: 9999;
    text-align: center;
    width: 400px;
}

.alert-box .alert-content p {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 500;
}

.alert-box button {
    background-color: #2e7d32;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.alert-box button:hover {
    background-color: #27632a;
}

/* Melhorias no formulário */
form {
    background: linear-gradient(to right, #fefefe, #f1f7ff);
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    max-width: 600px;
    margin: auto;
}

.btn-primary {
    background: linear-gradient(to right, #8bbae9, #598fbb);
    color: #fff;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 10px;
}

.btn-primary:hover {
    background: linear-gradient(to right, #11539e, #8dbcdd);
}


    .form-label {
        font-weight: 500;
        color: #444;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease;
        
    }
    .form-controls{
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease;
      max-height: 10rem;
        min-height: 10rem;
        max-width: 23rem;
        min-width: 23rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #a3d5ff;
        box-shadow: 0 0 0 0.2rem rgba(163, 213, 255, 0.25);
    }

    .container {
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .btn-flutuante {
    bottom: 30px;
    left: 30px;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 14px 24px;
    font-weight: bold;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 1000;
}

.btn-flutuante:hover {
    background-color: #3483d8;
}

.modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    overflow: auto; /* permite rolagem se necessário */
    align-items: center;
    justify-content: center;
}
.modal.aberto {
    display: flex !important;
}

.modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh; /* altura máxima da viewport */
    overflow-y: auto; /* rola apenas o conteúdo do modal */
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    position: relative;
}

.fechar {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 24px;
    color: #999;
    cursor: pointer;
}

.fechar:hover {
    color: #333;
}

.form-control-file {
    margin-top: 8px;
    border: 1px dashed #ccc;
    padding: 10px;
    border-radius: 8px;
    background-color: #fafafa;
    cursor: pointer;
    width: 100%;
}

.form-control-file:hover {
    background-color: #f0f0f0;
}
.contato-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 60px;
    padding: 30px;
    background: #f5f8fc;
    border-radius: 16px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.contato-info {
    flex: 1 1 400px;
    margin: 20px;
}

.contato-info h4 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #2b4d76;
}

.contato-info p, .contato-info a {
    font-size: 16px;
    color: #333;
    text-decoration: none;
}

.contato-info a:hover {
    text-decoration: underline;
    color: #11539e;
}

</style>
