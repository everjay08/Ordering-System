<?php

namespace App\Filament\Resources\TableReservationResource\Pages;

use App\Filament\Resources\TableReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTableReservation extends EditRecord
{
    protected static string $resource = TableReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
