<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name'];

    public function car()
    {
        return $this->belongsToMany('App\Car','car_colors');
    }
}
