<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    protected $fillable = ['image'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
