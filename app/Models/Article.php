<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ["category_id","article_name",'description','price','stock','is_active'];

    public function Article()
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
}
