<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citys extends Model
{
    //
        //
    protected $table = 'citys';
    public $timestamps = false;

    protected $fillable = [
		'city_id',
		'province_id',
		'province',
		'type',
		'city_name',
		'postal_code',
    ];
}
