<?php

namespace App\Filament\Resources\ViewCustomerOrderResource\Pages;

use App\Filament\Resources\ViewCustomerOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListViewCustomerOrders extends ListRecords
{
    protected static string $resource = ViewCustomerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
}
