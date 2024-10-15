<?php

namespace App\Filament\Resources\AgndasResource\Pages;

use App\Filament\Resources\AgndasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgndas extends EditRecord
{
    protected static string $resource = AgndasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
