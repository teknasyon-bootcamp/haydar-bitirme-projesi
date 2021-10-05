<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|match:passwordConfirm',
                'passwordConfirm' => 'required',
            ],
            [
                'name' => 'Ad Soyad',
                'email' => 'E-posta',
                'password' => 'Parola',
                'passwordConfirm' => 'Parola doğrulama'
            ]
        );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = password_hash($request->password, PASSWORD_BCRYPT);

        $user->create();
    }
}
