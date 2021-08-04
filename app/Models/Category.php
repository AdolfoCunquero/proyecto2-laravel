<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["category_name","is_active"];
    protected $primaryKey = "category_id";

    public function Category()
    {
        // laravel assumes user_id as foreign and local key.
        //return $this->hasMany('App\File');
        return $this->hasMany('App\Article', 'category_id', 'category_id');
    }
}
