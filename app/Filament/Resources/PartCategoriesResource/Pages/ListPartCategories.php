<?php

namespace App\Filament\Resources\PartCategoriesResource\Pages;

use App\Filament\Resources\PartCategoriesResource;
use App\Filament\Resources\PartCategoriesResource\Widgets\PartCategoryStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartCategories extends ListRecords
{
    protected static string $resource = PartCategoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Create new Part Category"),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PartCategoryStatsOverview::class
        ];
    }
}
