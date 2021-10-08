<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Request;
use Core\Session;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
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

        $newUserId = $user->create();

        
        Session::set('user_id',$newUserId);
        redirect('/');
    }

    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:8',
            ],
            [
                'email' => 'E-posta',
                'password' => 'Parola',
            ]
        );

        $user = User::where(['email' => $request->email]);

        if (empty($user) || !password_verify($request->password, $user[0]->password)) {
            $request->addHandlerError('userNotExist', "Verilen bilgilerle eşleşen kullanıcı bulunamadı.");

            return back();
        }   

        Session::set('user_id',$user[0]->id);
        redirect('/');

    }
}