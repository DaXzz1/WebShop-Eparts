<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use App\Models\Users;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Livewire\TemporaryUploadedFile;
use Ramsey\Uuid\Uuid;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = "Users";
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }


    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'email',
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
            'Email' => $record->email,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Username')
                    ->placeholder('Username')
                    ->disabled(fn($record) => $record?->id === auth()->id())
                    ->unique(User::class, 'name', ignorable: fn($record) => $record)
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->placeholder('Email')
                    ->disabled(fn($record) => $record?->id === auth()->id())
                    ->unique(User::class, 'email', ignorable: fn($record) => $record)
                    ->email()
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->placeholder('Password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->maxLength(32)
                    ->visibleOn('create')
                    ->required(),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Password Confirmation')
                    ->placeholder('Password Confirmation')
                    ->password()
                    ->same('password')
                    ->maxLength(32)
                    ->visibleOn('create')
                    ->required(),
                Forms\Components\FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->maxSize(1024 * 1024 * 5)
                    ->hint('Max file size 5MB')
                    ->disk('users_images')
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? array_values($state)[0] : "default.png")
                    ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => Uuid::uuid4() . "." . $file->getClientOriginalExtension()),
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->placeholder('Select Role')
                    ->searchable()
                    ->disabled(fn($record) => $record?->id === auth()->id())
                    ->options([
                        'admin' => 'Admin',
                        'manager' => 'Manager',
                        'user' => 'User',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('firstName')
                    ->label('First Name')
                    ->placeholder('First Name'),
                Forms\Components\TextInput::make('lastName')
                    ->label('Last Name')
                    ->placeholder('Last Name'),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->placeholder('Phone')
                    ->maxLength(100)
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                Forms\Components\Select::make('country')
                    ->label('Country')
                    ->placeholder('Select Country')
                    ->searchable()
                    ->options(function () {
                        $countries = config('stripe.available_countries');
                        $translatedCountries = [];

                        foreach ($countries as $key => $language) {
                            $translatedCountries[] = [$key + 1 => __('countries.' . $language)];
                        }

                        return array_merge(...$translatedCountries);
                    }),
                Forms\Components\TextInput::make('city')
                    ->label('City')
                    ->placeholder('City')
                    ->maxLength(100),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->placeholder('Address')
                    ->maxLength(100),
                Forms\Components\TextInput::make('zipCode')
                    ->label('Zip Code')
                    ->placeholder('Zip Code')
                    ->maxLength(100),
                Forms\Components\TextInput::make('state')
                    ->label('State')
                    ->placeholder('State')
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('stripe_id')
                    ->sortable()
                    ->label("Stripe ID")
                    ->icon(function ($record) {
                        return $record->stripe_id ? 'heroicon-o-check' : 'heroicon-o-x';
                    })
                    ->formatStateUsing(function ($record) {
                        return $record->stripe_id ? 'Exist' : 'Not Exist';
                    })
                    ->color(function ($record) {
                        return $record->stripe_id ? 'success' : 'danger';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('createdAt')
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        return Carbon::parse($record->createdAt)->format('H:i d/m/Y');
                    })
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Role')
                    ->options(['admin' => 'Admin', 'manager' => 'Manager', 'user' => 'User']),
                Tables\Filters\SelectFilter::make('stripe_id')
                    ->label('Stripe ID')
                    ->options(['true' => 'Exist', 'false' => 'Not Exist'])
                    ->query(function (Builder $query, array $data) {
                        if (empty($data["value"])) {
                            return $query->get();
                        }

                        return $query->where('stripe_id', $data["value"] === 'true' ? '!=' : '=', null)->get();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->disabled(fn($record) => $record?->id === auth()->id()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
