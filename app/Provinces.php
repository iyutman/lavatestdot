<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    //
    protected $table = 'provinces';
    public $timestamps = false;

    protected $fillable = [
        'province_id',
        'province',
    ];
}
