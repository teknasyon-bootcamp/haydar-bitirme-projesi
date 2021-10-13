<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\User;
use App\Models\UsersCategories;
use Core\Controller;
use Core\Log\Logger;
use Core\Request;
use Core\Session\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $log = new Logger();
        $log->info("Panelde tüm kategoriler sayfası ziyaret ediliyor.");

        return view('manage.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $log = new Logger();
        $log->info("Panelde tüm kategori ekleme sayfası ziyaret ediliyor.");

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
        $log = new Logger();

        $relation = UsersCategories::where(['category_id' => $request->id, 'user_id' => $request->user_id]);

        if (array_key_exists(0, $relation)) {

            $log->critical("Panelde editöre zaten eklenmiş bir kategori eklenmeye çalışıldı.");

            $request->addHandlerError('userNotExist', "Editör zaten kategoriye eklenmiş.");
            back();
        } else {
            $user = User::find($request->user_id);

            if ($user == null || $user->role_level >= 3) {
                $log->error("Panelde  kullanıcı yetkisini yetmediği bir kullanıcıya kategori eklenmeye çalışıldı.");
                $request->addHandlerError('roleNotAllowed', "Kendi yetki seviyenizi aşan kullanıcılarda değişiklik yapamazsınız.");
                back();
            }
        }

        $relation = new UsersCategories;

        $relation->category_id  = $request->id;
        $relation->user_id = $request->user_id;

        $id = $relation->create();

        Session::flash('success', "Kategori başarıyla editör eklendi.");

        $log->info("$id nolu kategori $request->user_id  kullancının yetkili olduğu kategorilere eklendi.");

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

        $log = new Logger();
        $relation = UsersCategories::where(['user_id' => $request->user_id])[0];

        if ($relation == null) {
            $log->error('Panelde var olmayan bir editör-kategori yetkisi silinmeye çalışıldı.');
            throw new NotFoundException();
        }

        $relation->delete();

        Session::flash('success', "Kategori başarıyla silindi.");

        $log->info("Editörden kategori yetkisi kaldırıldı");

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

        $log = new Logger();

        $category = new Category;

        $category->name = $request->name;

        $id = $category->create();

        Session::flash('success', "Kategori başarıyla kayıt edildi.");

        $log->info("$id nolu kategori eklendi.");
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

        $log = new Logger();

        $category = Category::find($request->id);

        if ($category == null) {
            $log->error('Panelde var olmayan bir kategori sayfası ziyaret edilmeye çalışıldı');
            throw new NotFoundException();
        }

        $categoryEditors = $category->editors();

        $editors = User::where(['role_level' => 2]);

        $log->info("Panelde $category->id nolu kategorinin düzenleme sayfası ziyaret ediliyor");

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

        $log = new Logger();
        $category = Category::find($request->id);

        if ($category == null) {
            $log->error('Panelde var olmayan bir kategori güncellemeye çalışıldı');
            throw new NotFoundException();
        }

        $category->name = $request->name;

        $category->update();
        Session::flash('success', "Kategori başarıyla güncellendi.");

        $log->info("Panelde $category->id nolu kategori düzenlendi");
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

        $log = new Logger();

        $category = Category::find($request->id);

        if ($category == null) {
            $log->error('Panelde var olmayan bir kategori silinmeye çalışıldı');
            throw new NotFoundException();
        }

        $category->delete();

        Session::flash('success', "Kategori başarıyla silindi.");
        $log->info("$category->id nolu kategori silindi");
        
        return back();
    }
}
