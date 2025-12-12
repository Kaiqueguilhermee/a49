<div class="section-header">
    <div class="section-title">
        @if($title == '+Jogados Da Semana')
            <img src="https://cdn.7games.bet.br/content/assets/icons/real-money.png?q=0&lossless=1&h=20&w=20" alt="Moeda" class="section-icon-img">
        @else
            <i class="{{ $icon }} section-icon"></i>
        @endif
        <h4 class="text-white font-semibold text-lg m-0">{{ $title }}</h4>
    </div>
    <div>
        <a href="{{ $link }}" class="section-link">
            @if(isset($labelLink)) {{ $labelLink }} @else Ver todos @endif 
            <i class="fa-regular fa-chevron-right"></i>
        </a>
    </div>
</div>
