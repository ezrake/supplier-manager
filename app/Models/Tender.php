<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use SoftDeletes;

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
        return $this->hasManyThrough('App\Models\Payment', 'App\Models\Order');
    }
}
