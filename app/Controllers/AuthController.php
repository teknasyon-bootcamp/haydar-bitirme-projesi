<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Controller;
use Core\Log\Logger;
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
        $log = new Logger();
        $log->info("Giriş sayfası ziyaret ediliyor.");
        return view('login', ['categories' => $this->categories]);
    }


    public function register()
    {
        $log = new Logger();
        $log->info("Kayıt sayfası ziyaret ediliyor.");
        return view('register', ['categories' => $this->categories]);
    }

    public function logout()
    {
        $log = new Logger();
        $log->info("Uygulamadan çıkış yapıldı.");

        Session::delete('user_id');
        return redirect('/');
    }
}
