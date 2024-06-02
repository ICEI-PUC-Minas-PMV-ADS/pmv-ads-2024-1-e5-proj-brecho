<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Infolists;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $modelLabel = 'Pedido';

    protected static ?array $statuses = [
        'pending' => 'Pendente',
        'canceled' => 'Cancelado',
        'processing' => 'Processando',
        'shipped' => 'Enviado',
        'finished' => 'Finalizado',
    ];

    protected static ?array $statuses_colors = [
        'pending' => 'warning',
        'canceled' => 'danger',
        'processing' => 'primary',
        'shipped' => 'success',
        'finished' => 'success',
    ];

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Cliente')
                    ->getOptionLabelUsing(fn ($value) =>
                        User::find($value)->getFilamentName()
                )->searchable()
                ->disabled(),
                Forms\Components\TextInput::make('address')
                    ->label('Logradouro')
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->label('Número')
                    ->required(),
                Forms\Components\TextInput::make('complement')
                    ->label('Complemento'),
                Forms\Components\TextInput::make('district')
                    ->label('Bairro')
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->label('Cidade')
                    ->required(),
                Forms\Components\TextInput::make('state')
                    ->label('Estado')
                    ->maxLength(2)
                    ->required(),
                Forms\Components\TextInput::make('cep')
                    ->label('CEP')
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(static::$statuses)
                    ->native(false)
                    ->required(),

                Forms\Components\TextInput::make('track_code')
                    ->label('Código de Rastreio')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label('Cliente')
                    ->formatStateUsing(function ($state, Order $order) {
                        return $order->user->first_name . ' ' . $order->user->last_name;
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state, Order $order) {
                        return static::$statuses[$order->status];
                    })
                    ->color(
                        function ($state, Order $order) {
                            return static::$statuses_colors[$order->status];
                        }
                    )
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Realizado em')
                    ->formatStateUsing(function ($state, Order $order) {
                        return $order->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s');
                    })

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(static::$statuses),
                DateRangeFilter::make('created_at')->
                    label('Data de Realização')->
                    placeholder('Selecione o intervalo de datas')->
                    timezone('America/Sao_Paulo')->
                    alwaysShowCalendar(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\OrderDetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
