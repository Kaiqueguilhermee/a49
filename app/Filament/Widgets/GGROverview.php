<?php

namespace App\Filament\Widgets;

use App\Models\GameLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GGROverview extends BaseWidget
{
    protected function getStats(): array
    {
        $creditoGastos = GameLog::count();
        $totalPartidas = GameLog::count();

        return [
            Stat::make('Total de Registros Drakon', $creditoGastos)
                ->description('Total de registros de jogos Drakon')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total de Partidas Drakon', $totalPartidas)
                ->description('Total de Partidas Drakon')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
        ];
    }

    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
