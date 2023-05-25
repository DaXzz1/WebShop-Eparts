<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getActions(): array
    {
        return [
                //
            ];
    }
}
