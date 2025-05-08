<?php
namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use App\Models\MenuItem;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CreateMenuItem extends CreateRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Call the stored procedure with the image path included
        DB::statement('CALL create_menu_item(?, ?, ?, ?, ?, ?, @last_id)', [
            $data['name'],
            $data['description'],
            $data['price'],
            $data['is_available'],
            $data['category_id'],
            $data['image'],
        ]);

        $lastId = DB::scalar('SELECT @last_id');

        return MenuItem::findOrFail($lastId);
    }
}