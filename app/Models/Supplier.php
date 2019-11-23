<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'contacts', 'account', 'user_id', 'tender_id'
    ];

    protected $casts = [
        'contacts' => 'array',
        'account' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
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
