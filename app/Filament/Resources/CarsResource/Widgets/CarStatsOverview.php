<?php

namespace App\Filament\Resources\CarsResource\Widgets;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\OrderProduct;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CarStatsOverview extends BaseWidget
{

    protected function getCards(): array
    {
        $popularModel = OrderProduct::selectRaw('cars.name as carName, car_models.name as modelName, count(*) as count')
            ->join('parts', 'parts.id', '=', 'order_products.partId')
            ->join('part_categories', 'part_categories.id', '=', 'parts.categoryId')
            ->join('car_models', 'car_models.id', '=', 'part_categories.modelId')
            ->join('cars', 'cars.id', '=', 'car_models.carId')
            ->groupBy('cars.name', 'car_models.name')
            ->orderBy('count', 'desc')
            ->first();

        $popularModel = isset($popularModel) && $popularModel->count > 0 ? $popularModel?->carName . ' ' . $popularModel?->modelName : "No orders yet";

        return [
            Card::make('Total Cars', Car::all()->count()),
            Card::make('Total Models', CarModel::all()->count()),
            Card::make('Most Popular Model', $popularModel),
        ];
    }
}
