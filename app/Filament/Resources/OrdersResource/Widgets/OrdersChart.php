<?php

namespace App\Filament\Resources\OrdersResource\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\LineChartWidget;

class OrdersChart extends LineChartWidget
{
    protected static ?string $heading = 'Orders Statistics Chart';

    protected function getData(): array
    {
        $order = Order::selectRaw('DATE(boughtAt) as date, count(*) as amount, sum(amount) as price')
            ->where('boughtAt', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->get();

        return [
            'labels' => $order->pluck('date'),
            'datasets' => [
                [
                    'label' => 'Total Orders Count',
                    'data' => $order->pluck('amount'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                ],
                [
                    'label' => 'Total Cost of Orders',
                    'data' => $order->pluck('price')->map(function ($price) {
                        return money($price, "eur")->getValue();
                    }),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ]
            ],
        ];
    }
}
