<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductCategory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'url',
        'logo',
        'cover',
        'color_1',
        'color_2',
        'min_order',
        'start_time',
        'end_time',
        'delievry_time',
        'delivery_fees',
        'is_susbended',
        'whatsapp',
        'currency',
        'domain',
        'displayCards',
        'dinIn',
        'pickUp',
        'delivery',
        'displayCards',
        'seo',
        'google_maps',
        'youtube',
        'facebook',
        'twitter',
        'instagram',
        'tiktok'
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->where('active', true);
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class)->where('active', true)->with('products');
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    
}
