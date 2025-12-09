@extends('layouts.web')

@push('styles')
<style>
    /* Esconder navegação mobile quando jogo está aberto */
    .mobile-bottom-nav {
        display: none !important;
    }
    
    /* Fazer o jogo ocupar toda a tela */
    .playgame {
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        position: relative;
    }
    
    /* Botão de voltar */
    .game-back-btn {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .game-back-btn:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.05);
    }
    
    .game-back-btn i {
        font-size: 18px;
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

   @include('includes.deposit')
@endsection
