<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'amount', 'transaction_details'
    ];

    protected $casts = [
        'transaction_details' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
