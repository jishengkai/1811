<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="user";
    protected $primaryKey="user_id";
    protected $fillable=['user_name','user_pwd','user_repwd','created_at','updated_at'];
    protected $dateFormat = 'U';
}
