<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewCustomerOrder extends Model
{
    protected $table = 'view_customer_orders';
protected $primaryKey = 'id';
public $incrementing = false;
public $keyType = 'int';
public $timestamps = false; // Not included in view

}
