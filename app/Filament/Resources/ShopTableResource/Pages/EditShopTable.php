<?php

namespace App\Filament\Resources\ShopTableResource\Pages;

use App\Filament\Resources\ShopTableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopTable extends EditRecord
{
    protected static string $resource = ShopTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
