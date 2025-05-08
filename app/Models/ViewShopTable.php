<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewShopTable extends Model
{
    protected $table = 'view_shop_tables';
    public $timestamps = false;

    // Optional: Make it read-only by disabling write operations
    public function save(array $options = []) { return false; }
}
