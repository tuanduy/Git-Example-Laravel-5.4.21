<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
  protected $table = 'car';
  protected $fillable = ['name','price'];

  public function color()
  {
    return $this->belongsToMany('App\Colors','car_colors');
  }
}
