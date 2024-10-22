<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendasResource\EventsRelationManagers;
use App\Filament\Resources\AgendasResource\Pages;
use App\Filament\Resources\AgendasResource\RelationManagers\ConferencesRelationManager;
use App\Filament\Resources\AgendasResource\RelationManagers\EventRelationManager;
use App\Filament\Resources\AgendasResource\RelationManagers\EventsRelationManager;
use App\Filament\Resources\AgendasResource\RelationManagers\SpecialGuestsRelationManager;
use App\Models\Agendas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AgendasResource extends Resource
{
    protected static ?string $model = Agendas::class;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\DateTimePicker::make('date')->required(),
]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('date'),

//                Tables\Columns\TextColumn::make('type_of_agenda')
//                    ->label('Type of Agenda')
//                    ->getStateUsing(function ($record) {
//                        if ($record->events()->exists()) {
//                            return 'Event';
//                        } elseif ($record->conferences()->exists()) {
//                            return 'Conference';
//                        } else {
//                            return 'Unknown';
//                        }
//                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            EventsRelationManager::class,
            ConferencesRelationManager::class,
            EventRelationManager::class,
            SpecialGuestsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgendas::route('/create'),
            'edit' => Pages\EditAgendas::route('/{record}/edit'),
        ];
    }
}
