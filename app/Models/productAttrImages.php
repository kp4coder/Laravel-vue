<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productAttrImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_attr_id',
        'image'
    ];
}
