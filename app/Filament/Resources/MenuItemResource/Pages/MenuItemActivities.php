<?php
 
namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use App\Models\MenuItem;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;
 
class MenuItemActivities extends ListActivities
{
    protected static string $resource = MenuItemResource::class;
}