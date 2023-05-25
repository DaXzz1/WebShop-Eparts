<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarsResource\Pages;
use App\Filament\Resources\CarsResource\Widgets\CarStatsOverview;
use App\Filament\Resources\ModelsResource\RelationManagers\ModelsRelationManager;
use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Ramsey\Uuid\Uuid;

class CarsResource extends Resource
{
    protected static ?string $model = Car::class;
    protected static ?string $navigationIcon = "heroicon-o-truck";
    protected static ?string $navigationGroup = "Vehicle";

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
        ];
    }

    public static function getRecordTitle(?Model $record): ?string
    {
        return $record?->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Name' => $record->name,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make("name")
                ->required()
                ->autofocus()
                ->unique(Car::class, "name", ignorable: fn($record) => $record)
                ->placeholder('Enter a Name e.g. "Audi"')
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    $set("slug", Str::slug($state));
                }),
            TextInput::make("slug")
                ->required()
                ->unique(Car::class, "slug", ignorable: fn($record) => $record)
                ->disabled()
                ->reactive(),
            FileUpload::make("image")
                ->required()
                ->label("Photo")
                ->maxSize(1024 * 1024 * 5)
                ->image()
                ->hint("Max file size 5MB")
                ->imagePreviewHeight(250)
                ->acceptedFileTypes(["image/jpeg", "image/png"])
                ->disk("car_icons")
                ->visibility("public")
                ->preserveFilenames()
                ->maxFiles(1)
                ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => Uuid::uuid4() . "." . $file->getClientOriginalExtension()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->sortable()
                    ->searchable(),
                TagsColumn::make("models.name")->limit(10),
                ImageColumn::make("image")
                    ->disk("car_icons")
                    ->extraImgAttributes(["class" => "object-cover"])
                    ->size(50)
                    ->height("auto"),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [ModelsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListCars::route("/"),
            "create" => Pages\CreateCars::route("/create"),
            "edit" => Pages\EditCars::route("/{record}/edit"),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CarStatsOverview::class
        ];
    }
}
