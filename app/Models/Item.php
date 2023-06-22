<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=['item_name','price','description','item_condition','item_type','status','image','uploader','phone','address','category_id','view_count','user_id','ltd','lng'];
}
