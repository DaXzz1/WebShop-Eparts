<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListUsers extends ListRecords
{
    protected static string $resource = UsersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
