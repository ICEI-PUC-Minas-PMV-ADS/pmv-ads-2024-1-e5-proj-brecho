<?php

namespace App\Filament\Resources;

use AbanoubNassem\FilamentPhoneField\Forms\Components\PhoneInput;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Usuários';

    protected static ?array $useres = [
        '1' => 'Administrador',
        '0' => 'Usuário Comum',
    ];

    protected static ?array $useres_colors = [
        '0' => 'primary',
        '1' => 'success',
    ];

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('Nome')
                    ->required()
                    ->placeholder('Digite o nome do usuário')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label('Sobrenome')
                    ->required()
                    ->placeholder('Digite o sobrenome do usuário')
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('Digite o email do usuário')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->required()
                    ->mask(RawJs::make(<<<'JS'
                        $input.length >= 14 ? '(99)99999-9999' : '(99)9999-9999'
                    JS))
                    ->placeholder('Digite o telefone do usuário'),
                Forms\Components\Select::make('is_admin')
                    ->label('Tipo de Usuário')
                    ->options(static::$useres)
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Sobrenome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_admin')
                    ->label('Tipo de Usuário')
                    ->formatStateUsing(function ($state, User $user) {
                        return static::$useres[$user->is_admin];
                    })
                    ->color(
                        function ($state, User $user) {
                            return static::$useres_colors[$user->is_admin];
                        }
                    )
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
