<div class="header-box">
    <div class="header-title">
        @if($title == '+Jogados Da Semana')
            <img src="https://cdn.7games.bet.br/content/assets/icons/real-money.png?q=0&lossless=1&h=20&w=20" alt="Dinheiro Real" style="width: 20px; height: 20px; margin-right: 10px;">
        @else
            <i class="{{ $icon }}" style="font-size: 23px;margin-right: 10px;color: #65cb24;"></i>
        @endif
        <h4>{{ $title }}</h4>
    </div>
    <div>
        <a href="{{ $link }}">@if(isset($labelLink)) {{ $labelLink }} @else Ver todos @endif <i class="fa-regular fa-chevron-right"  style="font-size: 18px;margin-left: 10px;color: #65cb24;"></i></a>
    </div>
</div>
