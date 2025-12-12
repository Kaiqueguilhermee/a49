@php
    // Pega jogos aleatórios do +Jogados da Semana
    $topGames = $topTrendGames ?? [];
    $mockNames = ['Carlos S***', 'Maria L***', 'João P***', 'Ana B***', 'Pedro M***', 'Lucia F***', 'Roberto C***', 'Juliana R***', 'Marcos T***', 'Fernanda A***', 'Rafael D***', 'Patricia G***', 'Bruno H***', 'Camila N***', 'Diego V***', 'Thiago M***', 'Amanda R***', 'Felipe G***'];
    
    $mockWinners = [];
    for ($i = 0; $i < 20; $i++) {
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

<div class="last-winners-container mb-6">
    <div class="last-winners-header">
        <img class="last-winners-trophy" src="https://cdn.7games.bet.br/content/assets/trofeu.png" alt="Troféu">
        <h2 class="last-winners-title">Últimos Ganhos Hoje</h2>
    </div>
    
    <div class="last-winners-carousel">
        <div class="last-winners-track">
            @foreach($mockWinners as $winner)
                <div class="last-winner-item">
                    <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}" class="last-winner-game-image">
                    <div class="last-winner-badge">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="last-winner-info">
                        <p class="last-winner-name">{{ $winner['name'] }}</p>
                        <p class="last-winner-game">{{ $winner['game'] }}</p>
                        <p class="last-winner-amount">{{ $winner['amount'] }}</p>
                    </div>
                </div>
            @endforeach
            @foreach($mockWinners as $winner)
                <div class="last-winner-item">
                    <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}" class="last-winner-game-image">
                    <div class="last-winner-badge">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="last-winner-info">
                        <p class="last-winner-name">{{ $winner['name'] }}</p>
                        <p class="last-winner-game">{{ $winner['game'] }}</p>
                        <p class="last-winner-amount">{{ $winner['amount'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
