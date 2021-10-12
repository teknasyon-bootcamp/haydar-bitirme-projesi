<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Models\Comment;
use Core\Controller;
use Core\Session\Session;
use Core\Request;

class CommentController extends Controller
{
    public function index()
    {

        $user = user();

        if ($user->role_level >= 3) {
            $comments = Comment::all();
        } else {
            $comments = Comment::where(['user_id' => $user->id]);
        }

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

        if ($request->anonim) {
            $comment->user_id = null;
        } else {
            $comment->user_id = user()->id ?? null;
        }

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

        $user = user();

        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            throw new ForbiddenException();
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

        $user = user();
        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            throw new ForbiddenException();
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

        $user = user();
        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            throw new ForbiddenException();
        }

        $comment->delete();

        Session::flash('success', "Yorum başarıyla silindi.");

        return back();
    }
}
