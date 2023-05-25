<?php

namespace App\Filament\Resources\PartCategoriesResource\Pages;

use App\Filament\Resources\PartCategoriesResource;
use App\Models\CarModel;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePartCategories extends CreateRecord
{
    protected static string $resource = PartCategoriesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['enName']);

        return $data;
    }
}
