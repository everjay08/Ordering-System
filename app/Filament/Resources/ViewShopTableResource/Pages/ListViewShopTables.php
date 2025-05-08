<?php

namespace App\Filament\Resources\ViewShopTableResource\Pages;

use App\Filament\Resources\ViewShopTableResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;

class ListViewShopTables extends ListRecords
{
    protected static string $resource = ViewShopTableResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('table_number'),
                Tables\Columns\TextColumn::make('capacity'),
                Tables\Columns\BooleanColumn::make('is_available'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([]) 
            ->bulkActions([]); 
    }

    protected function isTableRecordClickable(): bool
    {
        return false;
    }
}
