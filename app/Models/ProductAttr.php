<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'mrp',
        'price',
        'qty',
        'len',
        'breadth',
        'height',
        'weight'
    ];

    public function images() {
        return $this->hasMany(productAttrImages::class, 'product_attr_id', 'id');
    }
}
