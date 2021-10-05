<?php

namespace App\Controllers;

use Core\Controller;

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
}
