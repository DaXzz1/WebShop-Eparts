<?php

namespace App\Filament\Resources\PartCategoriesResource\Widgets;

use App\Models\Part;
use App\Models\PartCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PartCategoryStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $popularPart = Part::selectRaw('parts.enName, count(*) as count')
            ->join('part_categories', 'part_categories.id', '=', 'parts.categoryId')
            ->groupBy('parts.enName')
            ->orderBy('count', 'desc')
            ->first();

        return [
            Card::make('Total Part Categories', PartCategory::all()->count()),
            Card::make('Total Parts', Part::all()->count()),
            Card::make('Most Popular Part', $popularPart?->enName ?? "No orders yet"),
        ];
    }
}
