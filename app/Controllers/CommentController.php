<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Comment;
use Core\Controller;
use Core\Session\Session;
use Core\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return view('manage.comment.index', ['comments' => $comments]);
    }

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

    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id' => 'Yorum No',
            ]
        );

        $comment = Comment::find($request->id);

        if ($comment == null) {
            throw new NotFoundException();            
        }

        return view('manage.comment.edit', ['comment' => $comment]);
 
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'message' => 'required'
            ],
            [
                'id' => 'Yorum No',
                'message' => 'required'
            ]
        );

        $comment = Comment::find($request->id);

        if ($comment == null) {
            throw new NotFoundException();            
        }

        $comment->message = $request->message;

        $comment->update();

        Session::flash('success', "Yorum başarıyla güncellendi.");

        return back();
    }

    public function destory(Request $request)
    {
        $request->validate(
            [
                'id' => 'required'
            ],
            [
                'id' => 'Kategori No'
            ]
        );

        $comment = Comment::find($request->id);

        if ($comment == null) {
            throw new NotFoundException();            
        }
        
        $comment->delete();

        Session::flash('success', "Yorum başarıyla silindi.");

        return back();
    }
}
