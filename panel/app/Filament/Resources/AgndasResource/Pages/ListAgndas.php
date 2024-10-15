<?php

namespace App\Filament\Resources\AgndasResource\Pages;

use App\Filament\Resources\AgndasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgndas extends ListRecords
{
    protected static string $resource = AgndasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
