@props(['title', 'link' => '#', 'icon' => 'fa-duotone fa-gamepad-modern', 'linkText' => 'Ver todos'])

<div class="section-title-wrapper">
    <div class="section-title-container">
        <div class="section-title-left">
            @if($title == '+Jogados Da Semana' || $title == 'Mais Pagou Hoje')
                <img src="https://cdn.7games.bet.br/content/assets/icons/real-money.png?q=0&lossless=1&h=20&w=20" 
                     alt="Ícone" 
                     class="section-icon-img">
            @else
                <i class="{{ $icon }} section-icon"></i>
            @endif
            <h4 class="section-title">{{ $title }}</h4>
        </div>
        <div class="section-title-right">
            <a href="{{ $link }}" class="section-link">
                {{ $linkText }} 
                <i class="fa-regular fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
