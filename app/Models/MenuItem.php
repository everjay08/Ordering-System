<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MenuItem extends Model
{
    use LogsActivity;
    protected $guarded = [];

// app/Models/MenuItem.php

public function category()
{
    return $this->belongsTo(Category::class);
}
public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);
    }
 
public function scopeSearchName($query, $term)
{
    return $query->whereRaw("MATCH(name) AGAINST(? IN NATURAL LANGUAGE MODE)", [$term]);
}


public function scopeSearchDescription($query, $term)
{
    return $query->whereRaw("MATCH(description) AGAINST(? IN NATURAL LANGUAGE MODE)", [$term]);
}


}
