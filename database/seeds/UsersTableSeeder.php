<?php

use App\User;
use App\Store;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->insert([
        //     'name' => 'teste',
        //     'email' => 'teste',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => 'testeteste',
        // ]);

        factory(User::class, 20)->create()->each(function($user){
            $user->store()->save(factory(Store::class)->make());
        });
    }
}
