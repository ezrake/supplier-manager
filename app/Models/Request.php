<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $casts = [
        'items' => 'array',
        'details' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
