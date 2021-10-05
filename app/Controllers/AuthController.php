<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Request;

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
