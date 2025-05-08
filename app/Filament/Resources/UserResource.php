<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->rules('required', 'string', 'max:255'),
                TextInput::make('email')
                    ->required()
                    ->rules('required', 'string', 'email', 'max:255'),
                TextInput::make('password')
                    ->type('password')
                    ->required()
                    ->rules('required', 'string', 'min:8', 'confirmed'),
                Select::make('role')
                    ->required()
                    ->options([
                        'Admin' => 'Admin',
                        'Delivery' => 'Delivery',
                        'Customer' => 'Customer',
                    ])
                    ->default('Customer'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('activities')->url(fn ($record) => UserResource::getUrl('activities', ['record' => $record]))
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->modifyQueryUsing(function ($query) {
                $searchTerm = request('tableSearch');
                if ($searchTerm) {
                    return $query->fullTextSearch($searchTerm);
                }
                return $query;
            });
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'activities' => Pages\NewActivities::route('/{record}/activities')
        ];
    }
}
