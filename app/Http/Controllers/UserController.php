<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        $user = User::create([
            'name' => 'Isaac',
            'email' => 'isaacgoncod',
            'password'=> bcrypt('123mudar'),
        ]);

        return $user;
    }
}
