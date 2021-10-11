<?php

namespace App\Controllers;

use App\Models\Comment;
use Core\Controller;
use Core\Session\Session;
use Core\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'comment' => 'required',
            ],
            [
                'id' => 'Haber No',
                'comment' => 'Yorum',
            ]
        );

        $comment = new Comment;

        $comment->message = $request->comment;
        $comment->user_id = user()->id ?? null;
        $comment->news_id = $request->id;
       
        $comment->create();

      

        Session::flash('success', "Yorum başarıyla eklendi.");

        return back();
    }
}
