<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['id','name','price','catagogy_id'];
    public $timestamps = false;

    public function images()
    {
        return $this->hasMany('App\Images');
    }
}
