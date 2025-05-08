<?php

namespace App\Filament\Resources\TableReservationResource\Pages;

use App\Filament\Resources\TableReservationResource;
use App\Models\ShopTable;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTableReservation extends CreateRecord
{
    protected static string $resource = TableReservationResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        ShopTable::query()->where('id', $data['table_id'])->update([
            'is_available' => false,
        ]);

        return static::getModel()::create($data);
    }
}
