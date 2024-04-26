<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'order_details';

    protected static ?string $title = 'Produtos do pedido';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product.name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Produto')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantidade')->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Preço')->sortable()->money('BRL'),
                Tables\Columns\TextColumn::make('total')->label('Total')->sortable()->money('BRL'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
            ]);
    }
}
