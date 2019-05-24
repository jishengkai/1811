<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
    protected $primaryKey="cate_id";
    protected $dateFormat = 'U';
    protected $fillable=['cate_name','parent_id','keywords','created_at','desc','is_status','updated_id'];
}
