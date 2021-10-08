<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Controller;
use Core\Request;
use Core\Session\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('manage.category.index');
    }

    public function create(Request $request)
    {
        return view('manage.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255|unique:categories'
            ],
            [
                'name' => 'Kategori Adı'
            ]
        );

        $category = new Category;

        $category->name = $request->name;

        $category->create();

        Session::flash('success', "Kategori başarıyla kayıt edildi.");

        return back();

    }
}
