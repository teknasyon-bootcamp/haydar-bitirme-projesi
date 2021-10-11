<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Controller;
use Core\Session\Session;

class AuthController extends Controller
{
    public array $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    public function login()
    {
        return view('login', ['categories' => $this->categories]);
    }


    public function register()
    {
        return view('register', ['categories' => $this->categories]);
    }

    public function logout()
    {
        Session::delete('user_id');
        return redirect('/');
    }
}
