@extends('layouts.alunoheader')

@section('title', 'Mensalidades')
@section('page-title', 'Mensalidades')

@section('content')
<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; gap: 1.5rem; padding: 1rem;">

    <h1 style="text-align: center;">Pague sua Mensalidade</h1>

    <div style="display: flex; gap: 2rem; background: #fff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 6px rgb(0 0 0 / 0.1); max-width: 700px; width: 100%;">

        <!-- Informações -->
        <div style="flex: 1; border: 1px solid #ddd; padding: 1rem; border-radius: 8px;">
            <p><strong>Aluno:</strong> {{ $aluno->nome }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</p>
            <p><strong>Data de Referência:</strong> {{ $pagamento->data_referencia ? \Carbon\Carbon::parse($pagamento->data_referencia)->format('M/Y') : '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pagamento->status) }}</p>

            <div style="margin-top: 1rem; padding: 0.5rem; background: #f9f9f9; border: 1px solid #ccc; border-radius: 4px; font-family: monospace; font-size: 0.9rem; user-select: all; text-align: center;">
                Linha Digitável: <br>
                23790.12345 60001.234567 89012.345678 9 12345678901234
            </div>
        </div>

        <!-- QR Code Pix -->
        <div style="flex: 1; text-align: center; padding: 1rem; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Pagamento via Pix</h3>
            
            <div style="margin: 1rem auto; width: 250px; height: 250px; background: #000; border-radius: 12px; position: relative;">

                <!-- Fake QR code padrão (preto com quadrados brancos) -->
                <div style="position: absolute; top: 20px; left: 20px; width: 60px; height: 60px; background: #fff; border-radius: 6px;"></div>
                <div style="position: absolute; top: 20px; right: 20px; width: 60px; height: 60px; background: #fff; border-radius: 6px;"></div>
                <div style="position: absolute; bottom: 20px; left: 20px; width: 60px; height: 60px; background: #fff; border-radius: 6px;"></div>
                <!-- Quadrados menores dentro -->
                <div style="position: absolute; top: 35px; left: 35px; width: 30px; height: 30px; background: #000;"></div>
                <div style="position: absolute; top: 35px; right: 35px; width: 30px; height: 30px; background: #000;"></div>
                <div style="position: absolute; bottom: 35px; left: 35px; width: 30px; height: 30px; background: #000;"></div>

            </div>

            <p style="font-family: monospace; user-select: all; background: #f3f3f3; padding: 0.5rem; border-radius: 4px; word-break: break-all; font-size: 0.95rem;">
                00020126580014BR.GOV.BCB.PIX0114+55119999999990205.005802BR5909Fulano de Tal6009Sao Paulo61080540900062070503***6304
            </p>
        </div>

    </div>

</div>
@endsection
