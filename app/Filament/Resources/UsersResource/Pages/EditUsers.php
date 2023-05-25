<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUsers extends EditRecord
{
    protected static string $resource = UsersResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
