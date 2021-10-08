<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function register()
    {
        return view('register');
    }

    public function logout()
    {
        Session::delete('user_id');
        return redirect('/');
    }
}
