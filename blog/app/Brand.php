<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brand";
    public $timestamps=false;
    protected $primaryKey="id";
    protected $fillable = ['name','logo','url','desc','created_at','updated_at'];
}
