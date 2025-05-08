<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\ShopTable;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalSalesToday = Order::where('status', 'Delivered')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_amount');

        $totalOrdersToday = Order::where('status', 'Delivered')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $availableTables = ShopTable::where('is_available', true)->count();

        return [
            Stat::make('Sales Today', '₱ '.$totalSalesToday),
            Stat::make('Total Orders Today', $totalOrdersToday),
            Stat::make('Available Tables', $availableTables),

        ];
    }
}
