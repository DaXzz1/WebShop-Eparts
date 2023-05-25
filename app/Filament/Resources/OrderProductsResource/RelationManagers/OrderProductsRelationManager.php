<?php

namespace App\Filament\Resources\OrderProductsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderProductsRelationManager extends RelationManager
{
    protected static string $relationship = "parts";
    protected static ?string $recordTitleAttribute = "orderId";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make("orderId")
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("part.enName")
                    ->sortable()
                    ->searchable()
                    ->label("Product Name(EN)")
                    ->tooltip(function ($record) {
                        return $record->part->enName;
                    }),
                Tables\Columns\TextColumn::make("part.etName")
                    ->sortable()
                    ->searchable()
                    ->label("Product Name(ET)")
                    ->tooltip(function ($record) {
                        return $record->part->etName;
                    }),
                Tables\Columns\TextColumn::make("part.ruName")
                    ->sortable()
                    ->searchable()
                    ->label("Product Name(RU)")
                    ->tooltip(function ($record) {
                        return $record->part->ruName;
                    }),
                Tables\Columns\TextColumn::make("part.price")
                    ->sortable()
                    ->label("Price")
                    ->money("eur", true)
                    ->searchable()
                    ->tooltip(function ($record) {
                        return money(
                            $record->part->price,
                            "EUR",
                            true
                        )->format();
                    }),
                Tables\Columns\ImageColumn::make("part.image")
                    ->sortable()
                    ->searchable()
                    ->label("Image")
                    ->disk(function ($record) {
                        $car_slug = $record->part->category->model->car->slug;

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
                    ->size(100),
                Tables\Columns\TextColumn::make("quantity")
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // filter by price (asc, desc)
                Tables\Filters\SelectFilter::make("price")
                    ->form([
                        Forms\Components\Select::make("price")
                            ->disablePlaceholderSelection()
                            ->options([
                                "asc" => "Price (asc)",
                                "desc" => "Price (desc)",
                            ]),
                    ])
            ])
            ->actions([])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
