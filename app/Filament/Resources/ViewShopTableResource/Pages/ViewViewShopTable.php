<?php

namespace App\Filament\Resources\ViewShopTableResource\Pages;

use App\Filament\Resources\ViewShopTableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewViewShopTable extends ViewRecord
{
    protected static string $resource = ViewShopTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
