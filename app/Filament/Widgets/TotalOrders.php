<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TotalOrders extends ChartWidget
{
    protected static ?string $heading = 'Total Orders this Year';

    protected function getData(): array
    {
        $sucessfulOrders = Trend::query(Order::where('status', 'Delivered'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $cancelledOrders = Trend::query(Order::where('status', 'Cancelled'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Delivered Orders',
                    'data' => $sucessfulOrders->map(function (TrendValue $value) {
                        return $value->aggregate;
                    }),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
                [
                    'label' => 'Cancelled Orders',
                    'data' => $cancelledOrders->map(function (TrendValue $value) {
                        return $value->aggregate;
                    }),
                    'backgroundColor' => '#FF2C2C',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
