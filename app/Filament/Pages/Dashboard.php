<?php

namespace App\Filament\Pages;
use App\Filament\Widgets\TopMenuItemsWidget;
class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }
}


