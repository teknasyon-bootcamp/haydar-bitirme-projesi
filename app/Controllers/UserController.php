<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use App\Models\UserFollowedCategories;
use App\Models\UserSeenNews;
use Core\Controller;
use Core\Log\Logger;
use Core\Request;
use Core\Session\Session;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        $usersFiltered = [];
        $myRoleLevel = user()->role_level;

        if ($myRoleLevel != 4) {
            foreach ($users as $key => $user) {
                if ($user->role_level < $myRoleLevel) {
                    $usersFiltered[] = $user;
                }
            }
        } else {
            $usersFiltered = $users;
        }

        $log = new Logger();

        $log->info('Panelde kullanıcı rolleri sayfası ziyaret ediliyor');

        return view('manage.user.index', ['users' => $usersFiltered]);
    }

    public function main()
    {
        $news = [];

        $user = user();
        $followedModel = UserFollowedCategories::where(['user_id' => $user->id]);
        foreach ($followedModel as $key => $model) {

            // Combine array
            $news += News::where(['category_id' => $model->category_id]);
        }

        $log = new Logger();

        $log->info('Panelde takip edilen kategoriler sayfası ziyaret ediliyor');

        return view('manage.main', ['news' => $news]);
    }

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

        $log = new Logger();
        $log->info("$newUserId nolu kullanıcı oluşturuldu");

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

        $log = new Logger();

        if (empty($user) || !password_verify($request->password, $user[0]->password)) {
            $request->addHandlerError('userNotExist', "Verilen bilgilerle eşleşen kullanıcı bulunamadı.");
            $log->notice('Kullanıcı giriş bilgileri yanlış girildi');
            return back();
        }

        Session::set('user_id', $user[0]->id);

        $log->info($user[0]->id . " nolu kullanıcı giriş yaptı");
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

        $log = new Logger();

        if ($user == null) {
            $log->error('Var olmayan bir kullanıcı için hesap silme isteği yollandı.');
            throw new NotFoundException();
        }

        $message = "Hesap silme isteği işlendi.";

        if ($user->delete_request) {
            $message = "Hesap silme isteği iptal edildi.";
        }
        $user->delete_request =  (int)!$user->delete_request;

        $user->update();

        Session::flash('success',  $message);

        $log->info("$user->id nolu kullanıcının hesap silme isteği işlendi");

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
                $deleteRequestsByRole[] = $deleteRequest;
            }
        }

        $log = new Logger();

        $log->info("Panelde kullanıcı silme istekleri sayfası ziyaret ediliyor");
        return view('manage.user.deleteRequests', ['deleteRequests' => $deleteRequestsByRole]);
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

        $log = new Logger();

        if ($user == null) {
            $log->error('Var olmayan bir kullanıcının hesabı silinmeye çalışılıyor');
            throw new NotFoundException();
        } elseif ($user->role_level >= user()->role_level) {
            $request->addHandlerError('roleNotAllowed', "Kendi yetki seviyenizin üstündeki kullanıcıları silemezsiniz.");
            $log->error('Yetki seviyesinin üzerindeki bir kullanıcının hesabı silinmeye çalışılıyor');
            back();
        }

        $user->delete();

        Session::flash('success',  'Kullanıcı başarıyla silindi.');

        $log->error("$user->id nolu kullanıcının hesabı");

        back();
    }


    public function roleUpdate(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'role_level' => 'required',
            ],
            [
                'id' => 'Hesap No',
                'role_level' => 'Rol',
            ]
        );

        $user = User::find($request->id);

        $log = new Logger();

        if ($user == null) {
            $log->error('Var olmayan bir kullanıcının rolü değiştirilmeye çalışılıyor');
            throw new NotFoundException();
        }

        if (!in_array($request->role_level, [1, 2, 3, 4])) {
            $request->addHandlerError('invalidRole', "Geçersiz rol.");
            $log->error("$user->id nolu kullanıcının rolü geçersiz bir rol seviyesi ile değiştirilmeye çalışılıyor");
            back();
        }

        // I never call same db query twice B-)
        $myRoleLevel = user()->role_level;

        if ($request->role_level >=  $myRoleLevel && $myRoleLevel != 4) {
            $request->addHandlerError('roleNotAllowed', "Kullanıcıya kendi yetki seviyeniz ve üstündeki yetkileri veremezsiniz.");
            $log->error("Vermeye kullanıcın yetkisinin yetmeyeceği bir rol seviyesi verilmeye çalışılıyor");
            back();
        }

        if ($user->role_level >=  $myRoleLevel) {
            $request->addHandlerError('roleNotAllowed', "Yöneticinin yetkisini ancak kendisi değiştirebilir.");
            $log->error("Yöneticinin rol seviyesi değiştirilmeye çalışılıyor");
            back();
        }

        $user->role_level = $request->role_level;

        $user->update();

        Session::flash('success',  'Kullanıcı rolü başarıyla değiştirildi');

        $log->info("$user->id nolu kullanıcının rol seviyesi değiştirildi");

        back();
    }

    public function seenNews()
    {
        $user = user();

        $userSeenNews = UserSeenNews::where(['user_id' => $user->id]);

        $log = new Logger();

        $log->info("Panelde kullanıcının okuduğu haberler sayfası açılıyor");

        return view('manage.user.seenNews', ['userSeenNews' => $userSeenNews]);
    }


    public function requestFollow(Request $request)
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

        $log = new Logger();

        if ($category == null) {
            $log->error("Var olmayan bir kategori takip edilmeye çalışılıyor");
            throw new NotFoundException();
        }

        $user = user();

        $checkFollowedModel = UserFollowedCategories::where(['user_id' => $user->id, 'category_id' => $request->id]);

        if ($checkFollowedModel == null) {
            // Follow
            $followedModel = new UserFollowedCategories();
            $followedModel->user_id = $user->id;
            $followedModel->category_id = $request->id;

            $followedModel->create();
        } else {
            //Unfollow
            $checkFollowedModel[0]->delete();
        }

        $log->info("$category->id nolu kategori için kategori isteği atılıyor");

        back();
    }

    public function logs()
    {
        $logsArray = file(AppRootDirectory . "/storage/logs/app.log");

        $logsFiltered = '';

        $log = new Logger();
        $currentUser = user();

        if ($currentUser->role_level == 3) {
            foreach ($logsArray as $key => $log) {
                $firstWord = strtok($log, ' ');
                if ($firstWord != "Yönetici" && $firstWord != "Moderatör") {
                    $logsFiltered .= $log;
                }
            }
        } else {
            $logsFiltered = file_get_contents(AppRootDirectory . "/storage/logs/app.log");
        }

        $log->info("Kullanıcı aktiviteleri sayfası ziyaret ediliyor ");
        return view('manage.logs', ['logs' => $logsFiltered]);
    }
}
