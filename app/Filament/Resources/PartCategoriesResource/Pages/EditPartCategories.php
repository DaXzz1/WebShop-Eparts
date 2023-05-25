<?php

namespace App\Filament\Resources\PartCategoriesResource\Pages;

use App\Filament\Resources\PartCategoriesResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EditPartCategories extends EditRecord
{
    protected static string $resource = PartCategoriesResource::class;

    public function getTitle(): string
    {
        return "{$this->record->enName} - Edit";
    }

    protected function getActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['enName']);

        return $data;
    }
}
