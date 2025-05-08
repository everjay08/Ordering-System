<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use App\Models\Category;
use Filament\Tables\Actions\Action;


class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                FileUpload::make('image')
                    ->required()
                    ->directory('menu-items')
                    ->rules('required', 'image'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->rules('required', 'string', 'max:255'),
                Forms\Components\Textarea::make('description')
                    ->rules('nullable', 'string', 'max:255'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->integer()
                    ->rules('required', 'numeric', 'min:0'),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->required()
                    ->rules('required', 'exists:categories,id'),
                Forms\Components\Select::make('is_available')
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
                ImageColumn::make('image')
                    ->circular()
                    ->size(100),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                    ->prefix('₱ '),
                Tables\Columns\BooleanColumn::make('is_available'),
                Tables\Columns\TextColumn::make('category.name') 
                    ->label('Category')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('activities')->url(fn ($record) => MenuItemResource::getUrl('activities', ['record' => $record]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                
            ])->modifyQueryUsing(function ($query) {
                $searchTerm = request('tableSearch');
                if ($searchTerm) {
                    return $query->searchName($searchTerm);
                }
                return $query;
            });
                
    }
    

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
            'activities' => Pages\MenuItemActivities::route('/{record}/activities')
        ];
    }
}
