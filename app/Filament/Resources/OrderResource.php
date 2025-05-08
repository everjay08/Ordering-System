<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Pending')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        // dd(Order::with('menuItems')->get());

        return $table
            ->searchOnBlur()
            ->columns([
                TextColumn::make('customer.name')->searchable(),
                TextColumn::make('menuItems.name')
                    ->bulleted()
                    ->listWithLineBreaks(),
                TextColumn::make('total_amount')->prefix('₱ '),
                TextColumn::make('delivery.name')->searchable(),
                TextColumn::make('delivery_address')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'gray',
                        'Processing' => 'warning',
                        'Delivered' => 'success',
                        'Cancelled' => 'danger',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Processing' => 'Processing',
                        'Delivered' => 'Delivered',
                        'Cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('status')
                    ->icon('heroicon-s-pencil')
                    ->form([
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Processing' => 'Processing',
                                'Delivered' => 'Delivered',
                                'Cancelled' => 'Cancelled',
                            ]),
                    ])
                    ->action(function (array $data, Order $record): void {
                        $record->update([
                            'status' => $data['status'],
                        ]);
                    }),
                // Action::make('updateStatus')
                //     ->form([
                //         Select::make('status')
                //             ->options([
                //                 'Pending' => 'Pending',
                //                 'Processing' => 'Processing',
                //                 'Delivered' => 'Delivered',
                //                 'Cancelled' => 'Cancelled',
                //             ]),
                //     ])
                //     ->action(function (array $data, Order $record): void {
                //         $record->update([
                //             'status' => $data['status'],
                //         ]);
                //     }),
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
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
