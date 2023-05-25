<?php

namespace App\Filament\Resources\CarsResource\Pages;

use App\Filament\Resources\CarsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCars extends EditRecord
{
    protected static string $resource = CarsResource::class;

    public function getTitle(): string
    {
        return "{$this->record->name} - Edit";
    }

    protected function getActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
