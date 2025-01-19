<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesreport extends Model
{
    // TODO: Implement Salesreport
    protected $fillable = [
        'date', 
        'total_sales', 
        'order_id', 
    ];
}
