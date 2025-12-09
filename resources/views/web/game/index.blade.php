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
    }
</style>
@endpush

@section('content')
   <div class="playgame">
       <div class="playgame-body">
           <iframe src="{{ $gameUrl }}" class="game-full"></iframe>
       </div>
   </div>

   @include('includes.deposit')
@endsection
