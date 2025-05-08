<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViewCustomerOrderResource\Pages;
use App\Filament\Resources\ViewCustomerOrderResource\RelationManagers;
use App\Models\ViewCustomerOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViewCustomerOrderResource extends Resource
{
    protected static ?string $model = ViewCustomerOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
     
        Tables\Columns\TextColumn::make('customer_name')->searchable(),

       
        Tables\Columns\TextColumn::make('total_amount')->prefix('₱ '),

     
        Tables\Columns\TextColumn::make('status'),

       
        Tables\Columns\TextColumn::make('created_at')
            ->label('Order Date') 
            ->dateTime() 
            ->sortable(),

     
        Tables\Columns\TextColumn::make('menu_items_names')
            ->label('Menu Items')
            ->wrap()
            ->searchable(),
    ])
    ->actions([])
    ->bulkActions([]); 
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListViewCustomerOrders::route('/'),
            'create' => Pages\CreateViewCustomerOrder::route('/create'),
            'edit' => Pages\EditViewCustomerOrder::route('/{record}/edit'),
        ];
    }
}
