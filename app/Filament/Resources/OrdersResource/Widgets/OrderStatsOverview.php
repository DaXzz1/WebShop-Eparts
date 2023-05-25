<?php

namespace App\Filament\Resources\OrdersResource\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrderStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Orders', Order::all()->count()),
            Card::make('Total Earned', money(Order::all()->sum('amount'), "eur")),
            Card::make('Total Customers', User::all()->count()),
        ];
    }
}
