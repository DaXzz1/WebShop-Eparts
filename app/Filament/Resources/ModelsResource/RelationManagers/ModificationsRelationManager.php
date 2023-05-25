<?php

namespace App\Filament\Resources\ModelsResource\RelationManagers;

use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\ModelModification;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ModificationsRelationManager extends RelationManager
{
    protected static string $relationship = 'modifications';

    protected static ?string $recordTitleAttribute = 'modelId';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make("bodyId")
                    ->relationship("body", "bodyId")
                    ->required()
                    ->searchable()
                    ->label("Car Body Type")
                    ->validationAttribute("body")
                    ->placeholder("Select a Car Body Type")
                    ->getSearchResultsUsing(function (string $search) {
                        return BodyType::where("enName", "like", "%{$search}%")
                            ->get()
                            ->mapWithKeys(function ($body) {
                                return [$body->id => $body->enName];
                            });
                    })
                    ->options(function () {
                        return BodyType::orderBy("enName", "asc")->get()->mapWithKeys(function ($body) {
                            return [$body->id => $body->enName];
                        });
                    }),
                Forms\Components\TextInput::make("engineCode")
                    ->required()
                    ->dehydrateStateUsing(fn ($state) => Str::upper($state))
                    ->label("Engine Code")
                    ->placeholder("Engine Code"),
                Forms\Components\TextInput::make("engineCapacity")
                    ->required()
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->label("Engine Capacity")
                    ->placeholder("Engine Capacity")
                    ->hint("Engine Capacity in cc"),
                Forms\Components\Select::make("engineFuel")
                    ->required()
                    ->label("Engine Fuel")
                    ->placeholder("Select Engine Fuel")
                    ->options([
                        "petrol" => "Petrol",
                        "diesel" => "Diesel",
                        "hybrid" => "Hybrid",
                        "electric" => "Electric",
                        'gas' => 'Gas',
                    ]),
                Forms\Components\Select::make("transmissionType")
                    ->required()
                    ->label("Transmission Type")
                    ->placeholder("Select Transmission Type")
                    ->options([
                        "automatic" => "Automatic",
                        "manual" => "Manual",
                        "robotic" => "Robotic",
                        "variator" => "Variator",
                    ]),
                Forms\Components\Select::make("transmissionDrive")
                    ->required()
                    ->label("Transmission Drive")
                    ->placeholder("Select Transmission Drive")
                    ->options([
                        "front" => "Front Wheel",
                        "rear" => "Rear Wheel",
                        "full" => "All Wheel",
                    ]),
                Forms\Components\TextInput::make("enginePower")
                    ->label("Engine Power")
                    ->placeholder("Engine Power")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->hint("Engine Power in hp"),
                Forms\Components\TextInput::make("engineTorque")
                    ->label("Engine Torque")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Engine Torque")
                    ->hint("Engine Torque in Nm"),
                Forms\Components\TextInput::make("engineFuelConsumptionCity")
                    ->label("Engine Fuel Consumption City")
                    ->mask(fn (Mask $mask) => $mask
                        ->numeric()
                        ->decimalSeparator()
                        ->decimalPlaces(1))
                    ->placeholder("Engine Fuel Consumption City")
                    ->hint("Engine Fuel Consumption City in l/100km"),
                Forms\Components\TextInput::make("engineFuelConsumptionHighway")
                    ->label("Engine Fuel Consumption Highway")
                    ->mask(fn (Mask $mask) => $mask
                        ->numeric()
                        ->decimalSeparator()
                        ->decimalPlaces(1))
                    ->placeholder("Engine Fuel Consumption Highway")
                    ->hint("Engine Fuel Consumption Highway in l/100km"),
                Forms\Components\TextInput::make("engineFuelConsumptionCombined")
                    ->label("Engine Fuel Consumption Combined")
                    ->mask(fn (Mask $mask) => $mask
                        ->numeric()
                        ->decimalSeparator()
                        ->decimalPlaces(1))
                    ->placeholder("Engine Fuel Consumption Combined")
                    ->hint("Engine Fuel Consumption Combined in l/100km"),
                Forms\Components\Select::make("engineInjectionType")
                    ->label("Engine Injection Type")
                    ->placeholder("Select Engine Injection Type")
                    ->options([
                        "mpfi" => "MPFI",
                        "throttleBody" => "Throttle Body",
                        "multiPointInjection" => "Multi Point Injection",
                        "directInjection" => "Direct Injection",
                        "portInjection" => "Port Injection",
                        "sequentialInjection" => "Sequential Injection",
                        "commonRailInjection" => "Common Rail Injection",
                        "dieselInjection" => "Diesel Injection",
                        "hybridInjection" => "Hybrid Injection",
                        "electricInjection" => "Electric Injection",
                    ]),
                Forms\Components\TextInput::make("engineCylinderCount")
                    ->label("Engine Cylinders Count")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Engine Cylinders Count"),
                Forms\Components\TextInput::make("engineValveCount")
                    ->label("Engine Valves Count")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Engine Valves Count"),
                Forms\Components\TextInput::make("transmissionGearCount")
                    ->label("Transmission Gear Count")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Transmission Gear Count"),
                Forms\Components\TextInput::make("weight")
                    ->label("Weight")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Weight")
                    ->hint("Weight in kg"),
                Forms\Components\TextInput::make("clearance")
                    ->label("Clearance")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(2)->decimalSeparator())
                    ->placeholder("Clearance")
                    ->hint("Clearance in mm"),
                Forms\Components\TextInput::make("fuelTankCapacity")
                    ->label("Fuel Tank Capacity")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Fuel Tank Capacity")
                    ->hint("Fuel Tank Capacity in l"),
                Forms\Components\TextInput::make("seatsCount")
                    ->label("Seats Count")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Seats Count"),
                Forms\Components\TextInput::make("trunkCapacity")
                    ->label("Trunk Capacity")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Trunk Capacity")
                    ->hint("Trunk Capacity in l"),
                Forms\Components\TextInput::make("doorsCount")
                    ->label("Doors Count")
                    ->mask(fn (Mask $mask) => $mask->numeric()->decimalPlaces(0))
                    ->placeholder("Doors Count"),
                DatePicker::make("releasedAt")
                    ->required()
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")
                    ->label("ID")
                    ->sortable(),
                Tables\Columns\TextColumn::make("engineCode")
                    ->label("Engine Code")
                    ->sortable(),
                Tables\Columns\TextColumn::make("engineCapacity")
                    ->label("Engine Capacity")
                    ->sortable(),
                Tables\Columns\TextColumn::make("enginePower")
                    ->label("Engine Power")
                    ->sortable(),
                Tables\Columns\TextColumn::make("transmissionType")
                    ->label("Transmission Type")
                    ->sortable(),
                Tables\Columns\TextColumn::make("transmissionGearCount")
                    ->label("Transmission Gear Count")
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("transmissionType")
                    ->label("Transmission Type")
                    ->options(ModelModification::distinct()->get()->mapWithKeys(function ($item) {
                        return [$item->transmissionType => Str::title($item->transmissionType)];
                    })->toArray()),
                Tables\Filters\SelectFilter::make("engineInjectionType")
                    ->label("Engine Injection Type")
                    ->placeholder("All")
                    ->options(ModelModification::distinct()->get()->mapWithKeys(function ($item) {
                        return [$item->engineInjectionType => Str::title($item->engineInjectionType)];
                    })->toArray()),
                Tables\Filters\SelectFilter::make("engineFuel")
                    ->label("Engine Fuel Type")
                    ->placeholder("All")
                    ->options(ModelModification::distinct()->get()->mapWithKeys(function ($item) {
                        return [$item->engineFuel => Str::title($item->engineFuel)];
                    })->toArray()),
                Tables\Filters\SelectFilter::make("bodyType")
                    ->label("Body Type")
                    ->placeholder("All")
                    ->options(BodyType::all()->pluck("enName", "id")),
                Tables\Filters\SelectFilter::make("stoppedAt")
                    ->label("Production Status")
                    ->placeholder("All")
                    ->options([
                        'null' => 'In Production',
                        'not_null' => 'Not in Production',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data["value"] === "null") {
                            $query->whereNull("stoppedAt");
                        } elseif ($data["value"] === "not_null") {
                            $query->whereNotNull("stoppedAt");
                        }

                        return $query;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
