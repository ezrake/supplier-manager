<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Models\Users');
    }

    public function requisitions()
    {
        return $this->hasMany('App\Models\Requisition');
    }
}
