<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use App\Models\UserFollowedCategories;
use App\Models\UserSeenNews;
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

        if ($category == null) {
            throw new NotFoundException();
        }

        $isFollowedThisCategory = true;

        if (!isGuest()) {
            $followedModel = UserFollowedCategories::where(['user_id' => user()->id, 'category_id' => $category->id]);

            if ($followedModel != null) {
                $isFollowedThisCategory = false;
            }
        }


        $news = News::where(['category_id' => $request->id]);

        return view('category', ['news' => $news, 'categories' => $this->categories, 'category' => $category, 'isFollowedThisCategory' => $isFollowedThisCategory]);
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

        if (!isGuest()) {
            $user = user();

            $userSeenNews = UserSeenNews::where(['news_id' => $news->id, 'user_id' => $user->id]);

            if ($userSeenNews == null) {
                $userSeenNews = new UserSeenNews();
                $userSeenNews->user_id = $user->id;
                $userSeenNews->news_id = $news->id;

                $userSeenNews->create();
            }
        }

        return view('news', ['categories' => $this->categories, 'news' => $news, 'comments' => $comments]);
    }
}
