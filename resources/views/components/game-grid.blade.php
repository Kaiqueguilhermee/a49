@props([
    'games', 
    'columns' => '3', 
    'scrollable' => false,
    'showPrizes' => false,
    'showBadges' => false
])

@php
    $gridClass = $scrollable ? 'scroll-horizontal-mobile' : '';
    $colClass = "row-cols-{$columns} row-cols-md-6 mt-3 {$gridClass}";
@endphp

<div class="row {{ $colClass }}">
    @foreach($games as $game)
        <div class="col caixa-loop-elementos">
            <x-game-card 
                :game="$game" 
                :showBadge="$showBadges"
                :prizeValue="$showPrizes ? 'R$ ' . number_format(rand(1000, 50000) + (rand(0, 99) / 100), 2, ',', '.') : null"
            />
        </div>
    @endforeach
</div>
