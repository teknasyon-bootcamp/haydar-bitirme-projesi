<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        var_dump($request->all());
        return view('home', ['a' => 'cfv'] );
    }
}
