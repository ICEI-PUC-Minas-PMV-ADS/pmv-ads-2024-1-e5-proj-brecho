<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuários', DB::table('users')->count())
                ->icon('heroicon-o-users'),
            Stat::make('Produtos Cadastrados', DB::table('products')->count())->icon('heroicon-o-archive-box'),
            Stat::make('Pedidos', DB::table('orders')->count())->icon('heroicon-o-currency-dollar'),
        ];
    }
}
