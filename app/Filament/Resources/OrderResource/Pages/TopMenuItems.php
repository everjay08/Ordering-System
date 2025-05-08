<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class TopMenuItems extends Page
{
    protected static string $resource = OrderResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static string $view = 'filament.resources.order-resource.pages.top-menu-items';
    protected static ?string $navigationLabel = 'Top Menu Items';

    public array $topItems = [];

    public function mount(): void
    {
        $this->topItems = DB::select('CALL get_top_ordered_menu_items(?)', [5]);
    }
}