<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $table = 'status_mast';
  protected $primaryKey ='status_id';
  public $incrementing =false;
}
