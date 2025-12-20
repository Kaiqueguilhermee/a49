<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryResource\Pages;
use App\Models\Story;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->maxLength(191),

                        Forms\Components\FileUpload::make('images')
                            ->label('Imagens')
                            ->image()
                            ->multiple()
                            ->directory('stories'),

                        Forms\Components\TextInput::make('order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('active')
                            ->label('Ativo')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Imagem')
                    ->getStateUsing(fn($record) => is_array($record->images) && count($record->images) ? asset('storage/'.$record->images[0]) : null),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Título'),
                TextColumn::make('order')
                    ->sortable()
                    ->label('Ordem'),
                IconColumn::make('active')
                    ->boolean()
                    ->label('Ativo'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Criado')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStories::route('/'),
            'create' => Pages\CreateStory::route('/create'),
            'edit' => Pages\EditStory::route('/{record}/edit'),
        ];
    }
}
