<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopTableResource\Pages;
use App\Models\ShopTable;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShopTableResource extends Resource
{
    protected static ?string $model = ShopTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_available', true)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('table_number')
                    ->required()
                    ->unique()
                    ->rules('required', 'string', 'max:255'),
                TextInput::make('capacity')
                    ->required()
                    ->integer()
                    ->rules('required', 'numeric', 'min:0'),
                Select::make('is_available')
                    ->required()
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table_number')->searchable(),
                TextColumn::make('capacity'),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
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
            'index' => Pages\ListShopTables::route('/'),
            'create' => Pages\CreateShopTable::route('/create'),
            'edit' => Pages\EditShopTable::route('/{record}/edit'),
        ];
    }
}
