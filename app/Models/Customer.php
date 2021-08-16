<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ["email","first_name",'last_name','nit','address','phone','is_active'];
    protected $primaryKey = "customer_id";
}
