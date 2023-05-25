<?php

namespace App\Filament\Resources\UsersResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class UsersChart extends LineChartWidget
{
    protected static ?string $heading = 'Registred Users Chart';

    protected function getData(): array
    {
        $users = User::selectRaw('DATE(createdAt) as date, count(*) as amount')
            ->where('createdAt', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->get();

        return [
            'labels' => $users->pluck('date'),
            'datasets' => [
                [
                    'label' => 'Total Users Count',
                    'data' => $users->pluck('amount'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                ],
            ],
        ];
    }
}
