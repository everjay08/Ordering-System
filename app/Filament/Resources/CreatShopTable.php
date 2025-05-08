<?php
use App\Filament\Resources\ShopTableResource;
use App\Models\ShopTable;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CreateShopTable extends CreateRecord
{
    protected static string $resource = ShopTableResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        DB::statement('CALL sp_insert_shop_table(?, ?, ?, @last_id)', [
            $data['table_number'],
            $data['capacity'],
            $data['is_available'],
        ]);

        $last_id = DB::scalar('SELECT @last_id');

        return ShopTable::find($last_id);
    }
}