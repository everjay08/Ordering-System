<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopTable extends Model
{
    protected $guarded = [];

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
