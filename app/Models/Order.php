<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'details' => 'array',
        'delivered' => 'boolean',
        'is_deleted' => 'boolean'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
