<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $table = 'products_categories';

    protected $fillable = [
        'name',
        'store_id',
        'active'
    ];

    public function products ()
    {
        return $this->hasMany(Product::class, 'category_id')->where('active', true);
    }
}
