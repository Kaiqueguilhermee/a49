<?php

namespace App\Filament\Widgets;

use App\Models\GameLog;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class GgrTableWidget extends BaseWidget
{

    protected static ?string $heading = 'GGR Drakon';

    protected static ?int $navigationSort = -1;

    protected int | string | array $columnSpan = 'full';

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(GameLog::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('time')
                    ->label('Tempo'),
                Tables\Columns\TextColumn::make('game_id')
                    ->label('ID do Jogo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ip')
                    ->label('IP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_id')
                    ->label('Shop ID'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label('Data')
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Data Inicial'),
                        DatePicker::make('created_until')->label('Data Final'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Criação Inicial ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Criação Final ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ;
    }
}
