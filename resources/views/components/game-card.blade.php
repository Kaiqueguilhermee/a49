@props(['game', 'showBadge' => false, 'badgeText' => 'Novo', 'prizeValue' => null])

@php
    $service = strtolower($game->provider_service ?? $game->provider ?? '');
    $isDrakon = $service === 'drakon';
    
    // Definir rota baseado no tipo de jogo
    if (isset($game->game_code)) {
        $route = route('web.fivers.show', ['code' => $game->game_code]);
    } elseif (isset($game->game_id)) {
        $route = route('web.vibragames.show', ['id' => $game->game_id]);
    } elseif ($isDrakon || isset($game->uuid)) {
        $route = route('web.play', ['uuid' => $game->uuid]);
    } else {
        $route = route('web.game.index', ['slug' => $game->slug]);
    }
    
    // Definir imagem
    if (isset($game->game_cover)) {
        $image = asset('storage/' . $game->game_cover);
    } elseif (isset($game->banner)) {
        $image = asset('storage/' . $game->banner);
    } else {
        $image = str_starts_with($game->image, 'http') ? $game->image : asset('storage/' . $game->image);
    }
    
    $gameName = $game->game_name ?? $game->name;
@endphp

<div class="game-card-container">
    <a href="{{ $route }}" class="game-card-link">
        <div class="game-card-image">
            <img src="{{ $image }}" alt="{{ $gameName }}" class="img-fluid rounded-3" loading="lazy">
            
            @if($showBadge)
                <span class="game-card-badge">{{ $badgeText }}</span>
            @endif
            
            @if($prizeValue)
                <div class="game-card-prize">
                    <img src="https://cdn.7games.bet.br/content/assets/icons/real-money.png?q=0&lossless=1&h=20&w=20" alt="Moeda">
                    <span class="prize-label">Pagou Hoje</span>
                    <span class="prize-value">{{ $prizeValue }}</span>
                </div>
            @endif
        </div>
    </a>
</div>
