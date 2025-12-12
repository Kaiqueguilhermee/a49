@php
    $mockWinners = [
        ['name' => 'Carlos S***', 'game' => 'Fortune Tiger', 'amount' => 'R$ 531.000', 'image' => 'fortune-tiger.webp'],
        ['name' => 'Maria L***', 'game' => 'Gates of Olympus', 'amount' => 'R$ 255.000', 'image' => 'gates-olympus.webp'],
        ['name' => 'João P***', 'game' => 'Aviator', 'amount' => 'R$ 212.000', 'image' => 'aviator.webp'],
        ['name' => 'Ana B***', 'game' => 'Sweet Bonanza', 'amount' => 'R$ 190.000', 'image' => 'sweet-bonanza.webp'],
        ['name' => 'Pedro M***', 'game' => 'Fortune OX', 'amount' => 'R$ 188.000', 'image' => 'fortune-ox.webp'],
        ['name' => 'Lucia F***', 'game' => 'Spaceman', 'amount' => 'R$ 183.000', 'image' => 'spaceman.webp'],
        ['name' => 'Roberto C***', 'game' => 'Mines', 'amount' => 'R$ 157.000', 'image' => 'mines.webp'],
        ['name' => 'Juliana R***', 'game' => 'Fortune Rabbit', 'amount' => 'R$ 155.000', 'image' => 'fortune-rabbit.webp'],
        ['name' => 'Marcos T***', 'game' => 'Fortune Mouse', 'amount' => 'R$ 126.000', 'image' => 'fortune-mouse.webp'],
        ['name' => 'Fernanda A***', 'game' => 'Sugar Rush', 'amount' => 'R$ 124.000', 'image' => 'sugar-rush.webp'],
        ['name' => 'Rafael D***', 'game' => 'Dragon Hatch', 'amount' => 'R$ 123.000', 'image' => 'dragon-hatch.webp'],
        ['name' => 'Patricia G***', 'game' => 'Penalty Shoot Out', 'amount' => 'R$ 120.000', 'image' => 'penalty.webp'],
        ['name' => 'Bruno H***', 'game' => 'Fortune Tiger', 'amount' => 'R$ 115.000', 'image' => 'fortune-tiger.webp'],
        ['name' => 'Camila N***', 'game' => 'Gates of Olympus', 'amount' => 'R$ 114.000', 'image' => 'gates-olympus.webp'],
        ['name' => 'Diego V***', 'game' => 'Aviator', 'amount' => 'R$ 111.000', 'image' => 'aviator.webp'],
    ];
@endphp

<div class="last-winners-container mb-6">
    <div class="last-winners-header">
        <img class="last-winners-trophy" src="https://cdn.7games.bet.br/content/assets/trofeu.png" alt="Troféu">
        <h2 class="last-winners-title">Últimos Ganhos Hoje</h2>
    </div>
    
    <div class="last-winners-wrapper">
        @foreach($mockWinners as $winner)
            <div class="last-winner-item">
                <div class="last-winner-badge">
                    <i class="fa-solid fa-trophy text-yellow-400"></i>
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
