<?php

namespace App;

use App\User;
use App\Store;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['reference', 'status', 'pagseguro_code', 'store_id', 'items'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
