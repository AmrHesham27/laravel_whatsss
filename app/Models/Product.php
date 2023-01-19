<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'desc',
        'price',
        'image',
        'category_id',
        'active'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
