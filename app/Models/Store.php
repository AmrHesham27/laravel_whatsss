<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kitchen;
use App\Models\Product;
use App\Models\ProductCategory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'url',
        'logo',
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
        'subdomain',
        'displayCards',
        'dinIn',
        'pickUp',
        'deliveryPlaces'
    ];

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class, 'stores_kitchens');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function products_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    
}
