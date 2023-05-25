<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderProductsResource\RelationManagers\OrderProductsRelationManager;
use App\Filament\Resources\OrdersResource\Pages;
use App\Models\Order;
use App\Models\Part;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class OrdersResource extends Resource
{
    protected static ?string $model = Order::class;
    // money icons
    protected static ?string $navigationIcon = "heroicon-o-shopping-bag";
    protected static ?string $navigationGroup = "Orders";

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("user.name")
                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->user !== null ? $record->user->name : 'Unknown User';
                    })
                    ->url(
                        fn($record) => $record->user !== null ? "/admin/users/{$record->user->id}/edit" : null
                    )
                    ->tooltip(function ($record) {
                        return $record->user !== null ? "Click to Edit User" : null;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make("amount")
                    ->sortable()
                    ->searchable()
                    ->label("Total Price")
                    ->money("eur")
                    ->tooltip("Total Price"),
                Tables\Columns\BadgeColumn::make("status")
                    ->sortable()
                    ->searchable()
                    ->label("Status")
                    ->color(static function ($state) {
                        return match ($state) {
                            "paid" => "success",
                            "unpaid" => "danger",
                            default => "warning",
                        };
                    })
                    ->icon(static function ($state) {
                        return match ($state) {
                            "paid" => "heroicon-o-check-circle",
                            "unpaid" => "heroicon-o-exclamation-circle",
                            default => "heroicon-o-question-mark-circle",
                        };
                    })
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            "paid" => "Paid",
                            "unpaid" => "Unpaid",
                            default => "Unknown",
                        };
                    })
                    ->tooltip(function (BadgeColumn $column): ?string {
                        $state = $column->getState();

                        return match ($state) {
                            "paid" => "The order has been paid with Stripe",
                            "unpaid" => "The order has not been paid",
                            default => "The order status is unknown",
                        };
                    }),
                Tables\Columns\TextColumn::make("boughtAt")
                    ->sortable()
                    ->searchable()
                    ->tooltip("Date of Purchase")
                    ->formatStateUsing(function ($state) {
                        return Carbon::make($state)->format("d.m.Y H:i");
                    }),
            ])
            ->defaultSort("boughtAt", "desc")
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label("View")
                    ->icon("heroicon-o-eye")
                    ->color("primary"),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [OrderProductsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListOrders::route("/"),
            "view" => Pages\ViewOrder::route("/{record}/view"),
        ];
    }
}
