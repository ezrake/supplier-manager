<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'details', 'supplier_id', 'tender_id'
    ];

    protected $casts = [
        'details' => 'array',
        'delivered' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }

    public function requisitions()
    {
        return $this->hasMany('App\Models\Requisition');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
