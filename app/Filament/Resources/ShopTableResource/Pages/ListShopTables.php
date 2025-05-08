<?php

namespace App\Filament\Resources\ShopTableResource\Pages;

use App\Filament\Resources\ShopTableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopTables extends ListRecords
{
    protected static string $resource = ShopTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
