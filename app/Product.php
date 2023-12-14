<?php

namespace App;

use App\Store;
use App\Category;
use App\ProductsImages;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductsImages::class);
    }

    // public function setPriceAttribute($value)
    // {
    //     $this->attributes['price'] = (float) str_replace(['.', ','], ['', '.'], $value);
    // }

    // public function getPriceAttribute($value)
    // {
    //     return number_format($value, 2, ',', '.');
    // }
}
