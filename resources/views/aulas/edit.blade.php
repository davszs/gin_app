<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Administrador</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <form action="{{route('aulas.update', $aula->id)}}" method="POST">
        @csrf
        @method('PUT')
            <main class="container">
            <h1>Editar Aula</h1>

              <div class="input-box">
                <label for="nome">Nome:</label><br />
                <input type="text" name="nome" maxlength="50" required value="{{ old('nome') }}" />
                @error('nome') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
                <label for="descricao">Descrição:</label><br />
                <input type="text" name="descricao" maxlength="255" value="{{ old('descricao') }}" />
                @error('descricao') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
    <label for="dia_semana">Dia da Semana:</label><br />
    <select name="dia_semana" required>
        <option value="">Selecione um dia</option>
        <option value="seg" {{ old('dia_semana') == 'Segunda' ? 'selected' : '' }}>Segunda-feira</option>
        <option value="ter" {{ old('dia_semana') == 'Terça' ? 'selected' : '' }}>Terça-feira</option>
        <option value="qua" {{ old('dia_semana') == 'Quarta' ? 'selected' : '' }}>Quarta-feira</option>
        <option value="qui" {{ old('dia_semana') == 'Quinta' ? 'selected' : '' }}>Quinta-feira</option>
        <option value="sex" {{ old('dia_semana') == 'Sexta' ? 'selected' : '' }}>Sexta-feira</option>
        <option value="sab" {{ old('dia_semana') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
    </select>
    @error('dia_semana') 
        <small style="color:red">{{ $message }}</small> 
    @enderror
</div>

            <div class="input-box">
                <label for="horario_inicio">Horário de Início (HH:mm):</label><br />
                <input type="time" name="horario_inicio" required value="{{ old('horario_inicio') }}" />
                @error('horario_inicio') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
                <label for="horario_fim">Horário de Fim (HH:mm):</label><br />
                <input type="time" name="horario_fim" required value="{{ old('horario_fim') }}" />
                @error('horario_fim') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
                <label for="instrutor">Instrutor:</label><br />
                <input type="text" name="instrutor" maxlength="50" required value="{{ old('instrutor') }}" />
                @error('instrutor') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
                <label for="capacidade">Capacidade:</label><br />
                <input type="number" name="capacidade" min="1" required value="{{ old('capacidade') }}" />
                @error('capacidade') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div class="input-box">
                <label for="valor">Valor (R$):</label><br />
                <input type="number" name="valor" min="0" step="0.01" required value="{{ old('valor') }}" />
                @error('valor') <small style="color:red">{{ $message }}</small> @enderror
            </div>
            <div>
                <input type="submit" class="login" value="Atualizar dados">
            </div>
        </main>
    </form>
</body>

<script>
   
   
</script>

</html>