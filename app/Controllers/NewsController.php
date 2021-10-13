<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Core\Controller;
use Core\Log\Logger;
use Core\Request;
use Core\Session\Session;

class NewsController extends Controller
{
    public function index()
    {
        $currentUser = user();
        if ($currentUser->role_level >= 3) {
            $news = News::all();
        } else {
            $news = News::where(['user_id' => $currentUser->id]);
        }

        $log = new Logger;
        $log->info('Panelde haberler sayfası ziyaret ediliyor');

        return view('manage.news.index', ['news' => $news]);
    }

    public function create()
    {
        $currentUser = user();
        if ($currentUser->role_level >= 3) {
            $categories = Category::all();
        } else {
            $categories = $currentUser->getEditorCategories();
        }


        $log = new Logger;
        $log->info('Panelde haber ekleme sayfası ziyaret ediliyor');

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

        $log = new Logger;

        $user = user();
        if ($user->role_level >= 3) {
            $news->category_id = $request->category_id;
        } else {

            // User is a editör 

            if (!$user->isValidEditorCategory($request->category_id)) {
                $log->error('Yetkinin yetmediği bir kategoriye haber eklenilmeye çalışıldı.');
                $request->addHandlerError('roleNotAllowed', "Bu kategoriye haber ekleme yetkiniz yok.");
                back();
            }

            $news->category_id = $request->category_id;
        }

        $news->user_id = $user->id;

        $id = $news->create();

        Session::flash('success', "Haberi başarıyla eklendi.");


        $log = new Logger;
        $log->info("$id nolu haber eklendi");

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

        $log = new Logger;

        if ($news == null) {
            $log->error("Panelde var olmayan bir haber düzenlenmeye çalışıldı.");
            throw new NotFoundException();
        }
        $categories = Category::all();


        $log->info("Panelde $news->id nolu haberin düzenleme sayfası ziyaret ediliyor");

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

        $news = News::find($request->id);

        $log = new Logger();

        if ($news == null) {

            $log->error("Panelde var olmayan bir haber için güncelleme isteği yollandı");
            throw new NotFoundException();
        }

        $user = user();

        if ($user->role_level < 3 && $news->user_id != $user->id) {
            $log->error('Yetkinin yetmediği bir kullanıcıya ait haber güncellenmeye çalışıldı.');
            throw new ForbiddenException();
        }

        $newCoverImageName = $request->cover_image->getRandomizeName();

        $request->cover_image->move("uploads/" . $newCoverImageName);

        $news->title = $request->title;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->destroyAsset();
        $news->image = $newCoverImageName;

        $news->update();

        Session::flash('success', "Haber başarıyla güncellendi.");

        $log->info("Panelde $news->id nolu haber güncellendi");

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

        $log = new Logger();

        if ($news == null) {

            $log->error("Panelde var olmayan bir haber için silme isteği yollandı");
            throw new NotFoundException();
        }

        $user = user();

        if ($user->role_level < 3 && $news->user_id != $user->id) {

            $log->error('Yetkinin yetmediği bir kullanıcıya ait haber silinmeye çalışıldı.');
            throw new ForbiddenException();
        }


        $news->destroyAsset();
        $news->delete();

        Session::flash('success', "Haber başarıyla silindi.");

        $log->info("$news->id nolu haber silindi");
        return back();
    }

    public function apiIndex(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');

        if (isset($request->category)) {
            $news = News::where(['category_id' => $request->category]);

            if ($news == null) {
                http_response_code(404);
                return json_encode(['message' => "News Not Found"]);
            }

            return json_encode($news);
        } else {
            $news = News::all();

            if ($news == null) {
                http_response_code(404);
                return json_encode(['message' => "News Not Found"]);
            }

            return json_encode($news);
        }
    }

    public function apiShow(Request $request)
    {
        $news = News::find($request->id);

        header('Content-Type: application/json; charset=utf-8');

        if ($news == null) {
            http_response_code(404);
            return json_encode(['message' => "News Not Found"]);
        }

        return json_encode($news);
    }
}
