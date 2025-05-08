<?php

namespace App\Filament\Resources\ViewCustomerOrderResource\Pages;

use App\Filament\Resources\ViewCustomerOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditViewCustomerOrder extends EditRecord
{
    protected static string $resource = ViewCustomerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
