<?php

namespace App\Filament\Resources\ModelsResource\RelationManagers;

use App\Models\Car;
use App\Models\CarModel;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Ramsey\Uuid\Uuid;

class ModelsRelationManager extends RelationManager
{
    protected static string $relationship = "models";

    protected static ?string $recordTitleAttribute = "carId";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make("carId")
                ->required()
                ->placeholder('Enter a Car e.g. "Audi"')
                ->options(function () {
                    return Car::all()->mapWithKeys(function ($car) {
                        return [$car->id => $car->name];
                    });
                }),
            TextInput::make("name")
                ->required()
                ->placeholder('Enter a Model e.g. "A6"')
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    $set("slug", Str::slug($state));
                }),
            TextInput::make("slug")
                ->required()
                ->disabled()
                ->reactive(),
            DatePicker::make("releasedAt")
                ->label("Production Start Date")
                ->format("m.Y")
                ->displayFormat("m.Y")
                ->minDate(now()->subYears(75))
                ->maxDate(now())
                ->default(now())
                ->placeholder('Enter a year e.g. "03.2018"'),
            DatePicker::make("stoppedAt")
                ->label("Production End Date")
                ->format("m.Y")
                ->displayFormat("m.Y")
                ->minDate(now()->subYears(75))
                ->maxDate(now())
                ->placeholder('Enter a year e.g. "08.2022"'),
            FileUpload::make("image")
                ->required()
                ->label("Car Model Image")
                ->maxSize(1024 * 1024 * 5)
                ->image()
                ->hint("Max file size 5MB")
                ->imagePreviewHeight(250)
                ->acceptedFileTypes(["image/jpeg", "image/png"])
                ->disk(function ($record) {
                    resolve("filesystem")->forgetDisk("car_models");
                    app()["config"]->set("filesystems.disks.car_models", [
                        "driver" => "local",
                        "root" => public_path(
                            "images/cars/models/" . $record->car->slug
                        ),
                        "url" => "/images/cars/models/" . $record->car->slug,
                        "visibility" => "public",
                        "throw" => false,
                    ]);

                    return "car_models";
                })
                ->visibility("public")
                ->preserveFilenames()
                ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => Uuid::uuid4() . "." . $file->getClientOriginalExtension()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("releasedAt")->label(
                    "Release Start Date"
                ),
                Tables\Columns\TextColumn::make("stoppedAt")
                    ->label("Release End Date")
                    ->formatStateUsing(function ($state) {
                        return $state ?? "Present";
                    }),
                Tables\Columns\ImageColumn::make("image")
                    ->extraImgAttributes(["class" => "h-auto object-cover"])
                    ->size(100)
                    ->height("auto")
                    ->label("Image")
                    ->disk(function ($record) {
                        resolve("filesystem")->forgetDisk("car_models");
                        app()["config"]->set("filesystems.disks.car_models", [
                            "driver" => "local",
                            "root" => public_path(
                                "images/cars/models/" . $record->car->slug
                            ),
                            "url" =>
                                "/images/cars/models/" . $record->car->slug,
                            "visibility" => "public",
                            "throw" => false,
                        ]);

                        return "car_models";
                    }),
            ])
            ->filters([
                // ...
            ])
            ->headerActions([Tables\Actions\CreateAction::make()->label("Create a New Model")->modalHeading("Create a New Model")])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading(fn ($record) =>"Edit " . $record->name),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
