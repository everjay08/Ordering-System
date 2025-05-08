<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViewShopTableResource\Pages;
use App\Models\ViewShopTable;
use Filament\Resources\Resource;

class ViewShopTableResource extends Resource
{
    protected static ?string $model = ViewShopTable::class;
    protected static ?string $navigationIcon = 'heroicon-o-eye';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListViewShopTables::route('/'),
            'create' => Pages\CreateViewShopTable::route('/create'),
            'view' => Pages\ViewViewShopTable::route('/{record}'),
            'edit' => Pages\EditViewShopTable::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}
