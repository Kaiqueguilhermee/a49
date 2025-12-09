@extends('layouts.web')

@push('styles')
<style>
    /* Esconder navegação mobile quando jogo está aberto */
    .mobile-bottom-nav {
        display: none !important;
    }
    
    /* Garantir que o jogo ocupe toda a tela */
    body, html {
        overflow: hidden;
        margin: 0;
        padding: 0;
        height: 100%;
    }
    
    .playgame {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        z-index: 9999;
    }
    
    .playgame-body {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .game-full {
        width: 100% !important;
        height: 100% !important;
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* Botão de voltar */
    .game-back-btn {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 10000;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    
    .game-back-btn:hover {
        background: rgba(0, 0, 0, 0.95);
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }
    
    .game-back-btn i {
        font-size: 18px;
    }
    
    /* Esconder header/footer/navbar */
    header, footer, nav:not(.mobile-bottom-nav) {
        display: none !important;
    }

    /* Modal de Saldo Insuficiente */
    #noBalanceModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10001;
        justify-content: center;
        align-items: center;
    }
    
    .modal-content-balance {
        background: #1A1C20;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        max-width: 400px;
        margin: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .modal-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }
    
    .modal-title {
        color: white;
        margin-bottom: 15px;
        font-size: 24px;
    }
    
    .modal-text {
        color: #aaa;
        margin-bottom: 25px;
        font-size: 16px;
    }
    
    .modal-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .btn-modal-close {
        padding: 12px 24px;
        background: #333;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .btn-modal-close:hover {
        background: #444;
    }
    
    .btn-modal-deposit {
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .btn-modal-deposit:hover {
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
   <div class="playgame">
       <a href="{{ url('/') }}" class="game-back-btn">
           <i class="fas fa-arrow-left"></i>
           <span>Voltar</span>
       </a>
       <div class="playgame-body">
           <iframe src="{{ $gameUrl }}" class="game-full"></iframe>
       </div>
   </div>

   <!-- Modal de Saldo Insuficiente -->
   <div id="noBalanceModal">
       <div class="modal-content-balance">
           <div class="modal-icon">💰</div>
           <h3 class="modal-title">Saldo Insuficiente</h3>
           <p class="modal-text">Você não possui saldo suficiente para continuar jogando.</p>
           <div class="modal-buttons">
               <button onclick="closeNoBalanceModal()" class="btn-modal-close">Fechar</button>
               <a href="{{ route('panel.wallet.index') }}" class="btn-modal-deposit">Fazer Depósito</a>
           </div>
       </div>
   </div>
@endsection

@push('scripts')
<script>
    let balanceCheckCount = 0;
    
    function showNoBalanceModal() {
        document.getElementById('noBalanceModal').style.display = 'flex';
    }
    
    function closeNoBalanceModal() {
        document.getElementById('noBalanceModal').style.display = 'none';
    }
    
    // Verificar saldo do usuário
    function checkUserBalance() {
        fetch('/api/user/balance')
            .then(response => response.json())
            .then(data => {
                const currentBalance = parseFloat(data.balance || 0);
                
                // Se o saldo for menor que 1 real
                if (currentBalance < 1) {
                    balanceCheckCount++;
                    
                    // Mostrar modal após 2 verificações consecutivas
                    if (balanceCheckCount >= 2) {
                        showNoBalanceModal();
                        balanceCheckCount = 0;
                    }
                } else {
                    balanceCheckCount = 0;
                }
            })
            .catch(error => {
                console.log('Erro ao verificar saldo:', error);
            });
    }
    
    // Verificar saldo a cada 10 segundos
    setInterval(checkUserBalance, 10000);
    
    // Verificar saldo inicial após 5 segundos
    setTimeout(checkUserBalance, 5000);
</script>
@endpush
