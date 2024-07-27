<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = array('title');

    public function products()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_categories', 'category_id', 'product_id');
    }
}
