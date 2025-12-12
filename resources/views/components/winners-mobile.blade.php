@php
    $topGames = $topTrendGames ?? [];
    $mockNames = ['Jefferson F***', 'Wu Z***', 'Celso L***', 'Marco S***', 'Jose M***', 'Cintia A***', 'Elayne C***', 'Matheus C***', 'Patricia G***', 'Bruno H***', 'Camila N***', 'Diego V***'];
    $avatars = range(1, 40);
    
    $mockWinners = [];
    for ($i = 0; $i < 20; $i++) {
        if (count($topGames) > 0) {
            $game = $topGames[$i % count($topGames)];
            $mockWinners[] = [
                'name' => $mockNames[array_rand($mockNames)],
                'game' => $game->name,
                'amount' => 'R$ ' . number_format(rand(43, 154) * 1000 + rand(0, 999), 2, ',', '.'),
                'image' => str_starts_with($game->image, 'http') ? $game->image : asset('storage/'.$game->image),
                'avatar' => $avatars[array_rand($avatars)]
            ];
        }
    }
@endphp

<div class="top-winners-container-mobile">
    <!-- Tabs de Período -->
    <div class="top-winners-tabs-container">
        <div class="top-winners-tabs-text">
            <img src="https://cdn.7games.bet.br/react-app/cms/images/icons/clock-two_home.svg" alt="Clock">
            <p>Período:</p>
        </div>
        <div class="top-winners-tabs">
            <div class="top-winners-tab active">Hoje</div>
            <div class="top-winners-tab">3 Dias</div>
            <div class="top-winners-tab">7 Dias</div>
            <div class="top-winners-tab">15 Dias</div>
            <div class="top-winners-tab">30 Dias</div>
        </div>
    </div>

    <!-- Lista de Ganhadores com Scroll + Top Ganhos à direita -->
    <div class="top-winners-row-flex">
        <div class="top-winners-scroll">
            <div class="top-winners-track">
                @foreach($mockWinners as $winner)
                    <div class="top-winner-card">
                        <div class="top-winner-game-img">
                            <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}">
                        </div>
                        <div class="top-winner-info">
                            <div class="top-winner-player">
                                <div class="top-winner-avatar">
                                    <img class="avatar-roll" src="https://cdn.7games.bet.br/content/assets/rodela.svg">
                                    <img class="avatar-img" src="https://cdn.7games.bet/content/images/avatars/v2/{{ $winner['avatar'] }}.webp">
                                </div>
                                <p class="player-name">{{ $winner['name'] }}</p>
                            </div>
                            <span class="game-name">{{ $winner['game'] }}</span>
                            <p class="winner-amount">{{ $winner['amount'] }}</p>
                        </div>
                    </div>
                @endforeach
                @foreach($mockWinners as $winner)
                    <div class="top-winner-card">
                        <div class="top-winner-game-img">
                            <img src="{{ $winner['image'] }}" alt="{{ $winner['game'] }}">
                        </div>
                        <div class="top-winner-info">
                            <div class="top-winner-player">
                                <div class="top-winner-avatar">
                                    <img class="avatar-roll" src="https://cdn.7games.bet.br/content/assets/rodela.svg">
                                    <img class="avatar-img" src="https://cdn.7games.bet/content/images/avatars/v2/{{ $winner['avatar'] }}.webp">
                                </div>
                                <p class="player-name">{{ $winner['name'] }}</p>
                            </div>
                            <span class="game-name">{{ $winner['game'] }}</span>
                            <p class="winner-amount">{{ $winner['amount'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="top-winners-header side">
            <img src="https://cdn.7games.bet.br/content/assets/trofeu2.png?q=0&lossless=1&h=32&w=32" alt="Troféu">
            <p>Top Ganhos</p>
        </div>
    </div>
</div>
