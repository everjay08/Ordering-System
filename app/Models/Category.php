<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Allow mass assignment for the 'name' attribute
    protected $fillable = ['name'];

    // Define the relationship with MenuItem model
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
