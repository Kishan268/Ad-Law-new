<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country_mast';
	protected $primaryKey = 'country_code';
	protected $guarded = [];

}
