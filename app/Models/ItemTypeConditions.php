<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTypeConditions extends Model
{
    use HasFactory;
    protected $fillable=['item_type','item_condition'];
}
