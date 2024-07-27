<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = array('title','description','price','alert_quantity');

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_categories', 'product_id' ,'category_id');
    }
    
    public function stocks()
    {
        return $this->belongsToMany(ProductStock::class, 'product_stocks', 'product_id');
    }
}
