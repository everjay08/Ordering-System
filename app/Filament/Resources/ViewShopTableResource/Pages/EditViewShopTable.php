<?php

namespace App\Filament\Resources\ViewShopTableResource\Pages;

use App\Filament\Resources\ViewShopTableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditViewShopTable extends EditRecord
{
    protected static string $resource = ViewShopTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
