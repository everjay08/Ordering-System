<?php

namespace App\Filament\Resources\ShopTableResource\Pages;

use App\Filament\Resources\ShopTableResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShopTable extends CreateRecord
{
    protected static string $resource = ShopTableResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
