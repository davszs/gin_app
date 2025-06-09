@extends('layouts.alunoheader')

@section('title', 'Pagamento')
@section('page-title', 'Pagamento')

@section('content')
<div class="pagamento-container" style="display: flex; justify-content: center; align-items: center; padding: 2rem;">
    <div style="background: #eee; color: rgb(0, 0, 0); border-radius: 16px; padding: 2rem; width: 100%; max-width: 900px; box-shadow: 0 0 12px rgba(0,0,0,0.5);">
        
        <h2 style="text-align: center; color: #000000; margin-bottom: 1.5rem;">Pagamento da Mensalidade via PIX</h2>

        <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center;">
            <!-- Informações do Pagamento -->
            <div style="flex: 1 1 300px; background:  #acabab; padding: 1.5rem; border-radius: 12px; border: 1px solid #333;">
                <p><strong>Aluno:</strong> {{ $aluno->user->nome }}</p>
                <p><strong>Valor:</strong> R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</p>
                <p><strong>Referente a:</strong> {{ $pagamento->data_referencia ? \Carbon\Carbon::parse($pagamento->data_referencia)->format('m/Y') : '-' }}</p>
                <p><strong>Status:</strong> <span style="text-transform: capitalize;">{{ $pagamento->status }}</span></p>

                <div style="margin-top: 1rem; background: #ffffff; border: 1px dashed #555; padding: 1rem; border-radius: 8px; font-family: monospace; font-size: 0.95rem; color: #ccrgb(0, 0, 0)ext-align: center; word-wrap: break-word;">
                    <strong>Linha Digitável:</strong><br>
                    23790.12345 60001.234567 89012.345678 9 12345678901234
                </div>
            </div>

            <!-- QR Code PIX -->
            <div style="flex: 1 1 300px; background: #acabab; padding: 1.5rem; border-radius: 12px; border: 1px solid #333; text-align: center;">
                <h3 style="color: #1a1a1a; margin-bottom: 1rem;">Escaneie o QR Code</h3>

                <div style="margin: 0 auto 1rem; width: 250px; height: 250px; background: white; border-radius: 16px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <!-- Aqui você pode substituir pela imagem real do QR Code -->
                    <img src="{{ asset('images/qr_code.png') }}" alt="QR Code" style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <p style="font-family: monospace; font-size: 0.9rem; background: #1a1a1a; padding: 0.75rem; border-radius: 8px; color: #ccc; word-break: break-word;">
                    00020126580014BR.GOV.BCB.PIX0114+55119999999990205.005802BR5909Fulano de Tal6009Sao Paulo61080540900062070503***6304
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
