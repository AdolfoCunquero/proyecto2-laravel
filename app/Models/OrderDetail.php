<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ["article_id","order_id","quantity",'unit_price',"is_active"];
    protected $primaryKey = "order_detail_id";
}
