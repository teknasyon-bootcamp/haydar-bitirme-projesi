<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\User;
use App\Models\UsersCategories;
use Core\Controller;
use Core\Request;
use Core\Session\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('manage.category.index', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        return view('manage.category.create');
    }

    public function editorAdd(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'user_id' => 'required'
            ],
            [
                'id' => 'Yeni Kategory Adı',
                'user_id' => 'Yeni Editor Adı'
            ]
        );

        $relation = UsersCategories::where(['category_id' => $request->id, 'user_id' => $request->user_id]);

        if (array_key_exists(0, $relation)) {
            $request->addHandlerError('userNotExist', "Editör zaten kategoriye eklenmiş.");
            back();
        }

        $relation = new UsersCategories;

        $relation->category_id  = $request->id;
        $relation->user_id = $request->user_id;

        $relation->create();

        Session::flash('success', "Kategori başarıyla editör eklendi.");

        return back();
    }

    public function editorDelete(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required'
            ],
            [
                'user_id' => 'Editor No',
            ]
        );

        $relation = UsersCategories::where(['user_id' => $request->user_id])[0];

        if ($relation == null) {
            throw new NotFoundException();
        }

        $relation->delete();

        Session::flash('success', "Kategori başarıyla silindi.");

        return back();
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

    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required'
            ],
            [
                'id' => 'Kategori No'
            ]
        );

        $category = Category::find($request->id);

        if ($category == null ) {
            throw new NotFoundException();
        }

        $categoryEditors = $category->editors();

        $editors = User::where(['role_level' => 2]);

        return view('manage.category.edit', [
            'category' => $category,
            'editors' => $editors,
            'categoryEditors' => $categoryEditors
        ]);
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'name' => 'required'
            ],
            [
                'id' => 'Kategori No',
                'name' => 'Kategori Adı'
            ]
        );

        $category = Category::find($request->id);

        if ($category == null ) {
            throw new NotFoundException();
        }

        $category->name = $request->name;

        $category->update();
        Session::flash('success', "Kategori başarıyla güncellendi.");

        return back();
    }

    public function destroy(Request $request)
    {
        $request->validate(
            [
                'id' => 'required'
            ],
            [
                'id' => 'Kategori No'
            ]
        );

        $category = Category::find($request->id);

        if ($category == null ) {
            throw new NotFoundException();
        }

        $category->delete();

        Session::flash('success', "Kategori başarıyla silindi.");

        return back();
    }
}
