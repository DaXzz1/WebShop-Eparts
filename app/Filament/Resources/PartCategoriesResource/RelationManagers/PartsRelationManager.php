<?php

namespace App\Filament\Resources\PartCategoriesResource\RelationManagers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\ModelModification;
use App\Models\Part;
use App\Models\PartCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasRelationshipTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Ramsey\Uuid\Uuid;

class PartsRelationManager extends RelationManager
{
    protected static string $relationship = 'parts';

    protected static ?string $recordTitleAttribute = 'categoryId';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('modificationId')
                    ->relationship('modification', 'id')
                    ->label("Modification")
                    ->searchable()
                    ->placeholder('Select a Modification')
                    ->options(function () {
                        return ModelModification::orderBy('engineCode', 'asc')
                            ->get()
                            ->mapWithKeys(function ($modification) {
                                return [$modification->id => "{$modification->model->car->name} {$modification->model->name} - #{$modification->engineCode} ({$modification->engineCapacity}), {$modification->transmissionType}"];
                            });
                    }),
                Forms\Components\TextInput::make('enName')
                    ->autofocus()
                    ->required()
                    ->label("English Name")
                    ->placeholder('Enter a English Name'),
                Forms\Components\TextInput::make('etName')
                    ->required()
                    ->label("Estonian Name")
                    ->placeholder('Enter a Estonian Name'),
                Forms\Components\TextInput::make('ruName')
                    ->required()
                    ->label("Russian Name")
                    ->placeholder('Enter a Russian Name'),
                Forms\Components\FileUpload::make('image')
                    ->required()
                    ->label("Photo")
                    ->maxSize(1024 * 1024 * 5)
                    ->image()
                    ->hint("Max file size 5MB")
                    ->imagePreviewHeight(250)
                    ->acceptedFileTypes(["image/jpeg", "image/png"])
                    ->disk(function (RelationManager $livewire) {
                        $car_slug = $livewire->ownerRecord->model->car->slug;

                        if (!file_exists(public_path("images/parts/" . $car_slug))) {
                            mkdir(public_path("images/parts/" . $car_slug), 0777, true);
                        }

                        resolve("filesystem")->forgetDisk($car_slug);
                        app()["config"]->set("filesystems.disks." . $car_slug, [
                            "driver" => "local",
                            "root" => public_path(
                                "images/parts/" . $car_slug
                            ),
                            "url" => "/images/parts/" . $car_slug,
                            "visibility" => "public",
                            "throw" => false,
                        ]);

                        return $car_slug;
                    })
                    ->visibility("public")
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(fn(TemporaryUploadedFile $file): string => Uuid::uuid4() . "." . $file->getClientOriginalExtension()),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->reactive()
                    ->placeholder('Enter a Price')
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ',', decimalPlaces: 2, isSigned: false)),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->placeholder('Enter a Quantity'),
                Forms\Components\TextInput::make('manufacturer')
                    ->required()
                    ->placeholder('Enter a Code'),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->dehydrateStateUsing(fn(string $state) => Str::upper($state))
                    ->placeholder('Enter a Code'),
                Forms\Components\Select::make('color')
                    ->placeholder('Select a Color')
                    ->options([
                        "black" => "Black",
                        "white" => "White",
                        "silver" => "Silver",
                        "gray" => "Gray",
                        "red" => "Red",
                        "blue" => "Blue",
                        "green" => "Green",
                        "yellow" => "Yellow",
                        "brown" => "Brown",
                        "orange" => "Orange",
                        "purple" => "Purple",
                        "pink" => "Pink",
                        "gold" => "Gold",
                        "beige" => "Beige",
                    ]),
                Forms\Components\Select::make('location')
                    ->placeholder('Select a Location')
                    ->options([
                        "front" => "Front",
                        "back" => "Back",
                        "left" => "Left",
                        "right" => "Right",
                        "top" => "Top",
                        "bottom" => "Bottom",
                    ]),
                Forms\Components\TextInput::make('width')
                    ->placeholder('Enter a Width')
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask->numeric()->maxValue(9999)->maxLength(4)),
                Forms\Components\TextInput::make('height')
                    ->placeholder('Enter a Height')
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask->numeric()->maxValue(9999)->maxLength(4)),
                Forms\Components\TextInput::make('length')
                    ->placeholder('Enter a Length')
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask->numeric()->maxValue(9999)->maxLength(4)),
                Forms\Components\Select::make('material')
                    ->placeholder('Select a Material')
                    ->options([
                        "steel" => "Steel",
                        "aluminium" => "Aluminium",
                        "plastic" => "Plastic",
                        "glass" => "Glass",
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('etName')
                    ->label("Estonian Name")
                    ->limit(15)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('enName')
                    ->label("English Name")
                    ->limit(15)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ruName')
                    ->label("Russian Name")
                    ->limit(15)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.model.car.name')
                    ->label("Car Brand")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->money("EUR", true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label("Create a New Part")->using(function (HasRelationshipTable $livewire, array $data): Model {
                    return $livewire->getRelationship()->create($data);
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading(function ($record) {
                    return "Edit " . $record->enName;
                }),
                Tables\Actions\DeleteAction::make()->modalHeading(function ($record) {
                    return "Delete " . $record->enName;
                }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
