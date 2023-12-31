<?php

namespace App;

use App\UserOrder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

     public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }
}
