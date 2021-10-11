<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Core\Controller;
use Core\Request;

class GuestController extends Controller
{
    public array $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }
    public function welcome()
    {
        $news = News::all();

        return view('welcome', ['news' => $news, 'categories' => $this->categories]);
    }

    public function category(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id' => 'Kategori No',
            ]
        );

        $category = Category::find($request->id);
        $news = News::where(['id' => $request->id]);

        if ($category == null) {
            throw new NotFoundException();
        }

        return view('category', ['news' => $news, 'categories' => $this->categories, 'category' => $category]);
    }

    public function news(Request $request)
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

        $comments = Comment::where(['news_id' => $request->id]);
        return view('news', ['categories' => $this->categories, 'news' => $news, 'comments' => $comments]);
    }
}
