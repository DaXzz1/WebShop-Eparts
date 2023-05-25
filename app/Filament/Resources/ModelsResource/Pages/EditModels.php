<?php

namespace App\Filament\Resources\ModelsResource\Pages;

use App\Filament\Resources\ModelsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModels extends EditRecord
{
    protected static string $resource = ModelsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
