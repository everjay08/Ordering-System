<?php

namespace App\Filament\Widgets;

use App\Models\OrderMenuItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class MostOrderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $mostOrderedMenuItem = DB::table('order_menu_item')
    ->join('menu_items', 'order_menu_item.menu_item_id', '=', 'menu_items.id')
    ->select('menu_items.id as menu_item_id', 'menu_items.name', DB::raw('COUNT(order_menu_item.id) as total_orders'))
    ->groupBy('menu_items.id', 'menu_items.name')
    ->orderByDesc('total_orders')
    ->first();
    if (!$mostOrderedMenuItem) {
        return [
            Card::make('No Orders Yet', '0')->description('Most Ordered')
        ];
    }
        return [
            
                Card::make($mostOrderedMenuItem->name, $mostOrderedMenuItem->total_orders)->description('Most Ordered'),
            
            
        ];
    }
}
