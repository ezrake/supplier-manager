<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = [
        'department_id', 'order_id', 'items', 'status'
    ];

    protected $casts = [
        'items' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Requisition');
    }
}
