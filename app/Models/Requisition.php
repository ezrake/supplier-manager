<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $casts = [
        'items' => 'array',
        'details' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
