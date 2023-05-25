<?php

namespace App\Filament\Resources\CarsResource\Pages;

use App\Filament\Resources\CarsResource;
use App\Filament\Resources\CarsResource\Widgets\CarStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Contracts\HasRelationshipTable;
use Illuminate\Database\Eloquent\Model;

class ListCars extends ListRecords
{
    protected static string $resource = CarsResource::class;

    protected function getActions(): array
    {
        return [Actions\CreateAction::make()->label("Create New Car")];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CarStatsOverview::class,
        ];
    }
}
