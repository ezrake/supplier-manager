<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = [
        'details', 'status', 'expiry'
    ];

    protected $casts = [
        'details' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'expiry',
        'deleted_at'
    ];

    public function supplier()
    {
        return $this->hasOne('App\Models\Supplier');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Models\Payment', 'App\Models\Orders');
    }
}
