<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableReservationResource\Pages;
use App\Models\ShopTable;
use App\Models\TableReservation;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TableReservationResource extends Resource
{
    protected static ?string $model = TableReservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                    ->label('Customer Name')
                    ->required()
                    ->options(function () {
                        $customers = User::customers()->get();

                        return $customers->mapWithKeys(fn (User $user) => [$user->id => $user->name]);
                    }),
                Select::make('table_id')
                    ->label('Select Table')
                    ->required()
                    ->options(function () {
                        $customers = ShopTable::available()->get();

                        return $customers->mapWithKeys(fn (ShopTable $table) => [$table->id => $table->table_number]);
                    }),
                DateTimePicker::make('reservation_date')
                    ->minDate(now()->toDateString())
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->searchable(),
                TextColumn::make('table.table_number')->searchable(),
                TextColumn::make('reservation_date')->dateTime('Y m, d h:i:s A'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'gray',
                        'Confirmed' => 'warning',
                        'Cancelled' => 'danger',
                        'Done' => 'success',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('update_status')
                    ->icon('heroicon-s-pencil')
                    ->form([
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Confirmed' => 'Confirmed',
                                'Cancelled' => 'Cancelled',
                                'Done' => 'Done',
                            ]),
                    ])
                    ->action(function (array $data, TableReservation $record): void {
                        $status = $data['status'];

                        ShopTable::query()->where('id', $record->table_id)->update([
                            'is_available' => $status === 'Confirmed' ? false : true,
                        ]);

                        // TableReservation::query()
                        //     ->where('table_id', $record->table_id)
                        //     ->where('status', 'Pending')
                        //     ->update([
                        //         'status' => 'Cancelled',
                        //     ]);

                        $record->update([
                            'status' => $data['status'],
                        ]);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTableReservations::route('/'),
            'create' => Pages\CreateTableReservation::route('/create'),
            'edit' => Pages\EditTableReservation::route('/{record}/edit'),
        ];
    }
}
