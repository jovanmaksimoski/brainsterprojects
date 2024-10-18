<?php

namespace App\Filament\Resources\AgendasResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConferencesRelationManager extends RelationManager
{
    protected static string $relationship = 'conferences';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\DateTimePicker::make('date'),
                Forms\Components\TextInput::make('title'),
                Forms\Components\TextInput::make('theme'),
                Forms\Components\TextInput::make('description'),
                Forms\Components\TextInput::make('objective'),
                Forms\Components\TextInput::make('location'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('theme'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('objective'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('status'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
