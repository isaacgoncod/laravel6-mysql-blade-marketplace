<?php

use App\Store;
use App\Product;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();

        foreach($stores as $store){
            $store->products()->save(factory(Product::class)->make());
        }
    }
}
