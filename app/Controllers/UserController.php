<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\User;
use Core\Controller;
use Core\Request;
use Core\Session\Session;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8|match:passwordConfirm',
                'passwordConfirm' => 'required',
            ],
            [
                'name' => 'Ad Soyad',
                'email' => 'E-posta',
                'password' => 'Parola',
                'passwordConfirm' => 'Parola doğrulama'
            ]
        );

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = password_hash($request->password, PASSWORD_BCRYPT);

        $newUserId = $user->create();


        Session::set('user_id', $newUserId);
        redirect('/');
    }

    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:8',
            ],
            [
                'email' => 'E-posta',
                'password' => 'Parola',
            ]
        );

        $user = User::where(['email' => $request->email]);

        if (empty($user) || !password_verify($request->password, $user[0]->password)) {
            $request->addHandlerError('userNotExist', "Verilen bilgilerle eşleşen kullanıcı bulunamadı.");

            return back();
        }

        Session::set('user_id', $user[0]->id);
        redirect('/');
    }

    public function request(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id' => 'Hesap No',
            ]
        );

        $user = User::find($request->id);

        if ($user == null) {
            throw new NotFoundException();
        }

        $message = "Hesap silme isteği işlendi.";

        if ($user->delete_request) {
            $message = "Hesap silme isteği iptal edildi.";
        }
        $user->delete_request =  (int)!$user->delete_request;

        $user->update();

        Session::flash('success',  $message);

        back();
    }

    public function requestView()
    {
        $deleteRequests = User::where(['delete_request' => 1]);

        $deleteRequestsByRole = [];

        // I didn't want every time iterate user function in foreach 
        $myRoleLevel = user()->role_level;

        foreach ($deleteRequests as $key => $deleteRequest) {
            if ($deleteRequest->role_level < $myRoleLevel) {
                $deleteRequestsByRole [] = $deleteRequest;
            }
        }

        return view('manage.deleteRequests', ['deleteRequests' => $deleteRequestsByRole]);
    }

    public function destroy(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
            ],
            [
                'id' => 'Hesap No',
            ]
        );

        $user = User::find($request->id);

        if ($user == null) {
            throw new NotFoundException();
        } elseif ($user->role_level >= user()->role_level) {
            $request->addHandlerError('roleNotAllowed', "Kendi yetki seviyenizin üstündeki kullanıcıları silemezsiniz.");
            back();
        }

        $user->delete();

        Session::flash('success',  'Kullanıcı başarıyla silindi.');

        back();
    }
}
