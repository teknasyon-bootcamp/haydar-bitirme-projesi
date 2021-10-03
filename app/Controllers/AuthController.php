<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
}
