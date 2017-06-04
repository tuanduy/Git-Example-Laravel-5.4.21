<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaPham extends Model
{
    protected $table = 'kpt_khoapham';
    protected $fillable = ['id', 'monhoc','giatien','gianvien','image'];
    public $timestamps = false;
}
