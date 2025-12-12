@php
    // Pega jogos aleatórios do +Jogados da Semana
    $topGames = $topTrendGames ?? [];
    $mockNames = ['Carlos S***', 'Maria L***', 'João P***', 'Ana B***', 'Pedro M***', 'Lucia F***', 'Roberto C***', 'Juliana R***', 'Marcos T***', 'Fernanda A***', 'Rafael D***', 'Patricia G***', 'Bruno H***', 'Camila N***', 'Diego V***'];
    
    $mockWinners = [];
    for ($i = 0; $i < 15; $i++) {
        if (count($topGames) > 0) {
            $game = $topGames[$i % count($topGames)];
            $mockWinners[] = [
                'name' => $mockNames[array_rand($mockNames)],
                'game' => $game->name,
                'amount' => 'R$ ' . number_format(rand(100, 999), 0, ',', '.') . '.000',
                'image' => str_starts_with($game->image, 'http') ? $game->image : asset('storage/'.$game->image)
            ];
        }
    }
@endphp

<div class="winners-mobile-container">
    <div class="winners-mobile-track">
        @foreach($mockWinners as $winner)
            <div class="winner-mobile-item">
                <div class="winner-info-left">
                    <p class="winner-name">{{ $winner['name'] }}</p>
                    <p class="winner-amount">{{ $winner['amount'] }}</p>
                </div>
                <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}" class="winner-game-img">
            </div>
        @endforeach
        @foreach($mockWinners as $winner)
            <div class="winner-mobile-item">
                <div class="winner-info-left">
                    <p class="winner-name">{{ $winner['name'] }}</p>
                    <p class="winner-amount">{{ $winner['amount'] }}</p>
                </div>
                <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}" class="winner-game-img">
            </div>
        @endforeach
    </div>
</div>
