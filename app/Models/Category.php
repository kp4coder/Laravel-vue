<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_category_id',
        'image'
    ];

    public function parentCategory() {
        return $this->hasOne(Category::class, 'id', 'parent_category_id');
    }
}
