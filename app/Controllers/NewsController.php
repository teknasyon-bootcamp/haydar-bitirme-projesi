<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Core\Controller;
use Core\Request;
use Core\Session\Session;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('manage.news.index', ['news' => $news]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('manage.news.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'reqired',
                'cover_image' => 'required|image|max_size:3096'
            ],
            [
                'title' => 'Haber Başlığı',
                'content' => 'İçeriği',
                'category_id' => 'Kategori',
                'cover_image' => 'Kapak Görseli'
            ]
        );

        $newCoverImageName = $request->cover_image->getRandomizeName();

        $request->cover_image->move("uploads/" . $newCoverImageName);

        $news = new News;

        $news->title = $request->title;
        $news->content = $request->content;
        $news->image = $newCoverImageName;
        $news->category_id = $request->category_id;
        $news->user_id = Session::get('user_id');

        $news->create();

        Session::flash('success', "Haberi başarıyla eklendi.");

        return back();
    }

    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id' => 'Haber No',
            ]
        );

        $news = News::find($request->id);

        if ($news == null) {
            throw new NotFoundException();
        }
        $categories = Category::all();

        return view('manage.news.edit', ['news' => $news, 'categories' => $categories, 'comments' => []]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'cover_image' => 'required|image|max_size:3096'
            ],
            [
                'id' => 'Haber No',
                'title' => 'Haber Başlığı',
                'content' => 'İçeriği',
                'category_id' => 'Kategori',
                'cover_image' => 'Kapak Görseli'
            ]
        );


        $newCoverImageName = $request->cover_image->getRandomizeName();

        $request->cover_image->move("uploads/" . $newCoverImageName);

        $news = News::find($request->id);

        $news->title = $request->title;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->destroyAsset();
        $news->image = $newCoverImageName;

        $news->update();

        Session::flash('success', "Haber başarıyla güncellendi.");

        return back();
    }

    public function destroy(Request $request)
    {
        $request->validate(
            [
                'id' => 'required'
            ],
            [
                'id' => 'Haber No'
            ]
        );

        $news = News::find($request->id);

        $news->destroyAsset();
        $news->delete();

        Session::flash('success', "Haber başarıyla silindi.");

        return back();
    }
}
