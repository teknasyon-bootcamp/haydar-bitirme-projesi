<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Models\Comment;
use Core\Controller;
use Core\Log\Logger;
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

        $log = new Logger();
        $log->info("Panelde tüm yorumlar sayfası ziyaret ediliyor.");

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

        $log = new Logger();
        $log->info("$request->id nolu habere yeni yorum eklendi.");

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

        $log = new Logger();
        
        if ($comment == null) {
            $log->error('Panelde var olmayan bir yorum düzenlenmeye çalışılıyor');
            throw new NotFoundException();
        }

        $user = user();

        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            $log->error('Yetki seviyesinin yetmediği bir yorum düzenlenmeye çalışılıyor');
            throw new ForbiddenException();
        }

        $log->info("Panelde $comment->id nolu yorumun düzenleme sayfası ziyaret ediliyor");
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

        $log = new Logger();
        if ($comment == null) {
            $log->error('Panelde var olmayan bir yorumu düzenlemek için put isteği attı.');
            throw new NotFoundException();
        }

        $user = user();
        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            $log->error('Yetki seviyesinin yetmediği bir yorum düzenlenmek için put isteği atıldı.');
            throw new ForbiddenException();
        }

        $comment->message = $request->message;

        $comment->update();

        Session::flash('success', "Yorum başarıyla güncellendi.");

        $log->info("Panelde $comment->id nolu yorum düzenlendi.");
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

        $log = new Logger();

        if ($comment == null) {
            $log->error('Panelde var olmayan bir yorumu düzenlemek için put isteği attı.');
            throw new NotFoundException();
        }

        $user = user();
        if ($user->role_level < 3 && $user->id != $comment->user_id) {
            $log->error('Yetki seviyesinin yetmediği bir yorum düzenlenmek için put isteği atıldı.');
            throw new ForbiddenException();
        }

        $comment->delete();

        Session::flash('success', "Yorum başarıyla silindi.");
        
        $log->info("Panelde $comment->id nolu yorum silindi.");

        return back();
    }
}
