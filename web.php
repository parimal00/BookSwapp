<?php

use App\Events\ChatEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadBookController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use App\Models\User;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('event', function () {
    event(new ChatEvent("abcd", "abcrerd", "abdcd", "afdf"));
});


Route::get('/', function () {
    return view('loginForm');
});

Route::get('logout', [UploadBookController::class, 'logout']);
Route::get('/home', function () {
    return view('welcome');
})->name('home');
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    try {



        $user = Socialite::driver('google')->user();



        $finduser = User::where('email', $user->email)->first();



        if ($finduser) {
            $pusher_path = DB::table('pusher_path')
                ->where('email', $user->getEmail())
                ->get();

            if (count($pusher_path) == 0) {
                $pusherPath = md5(uniqid(rand(), true));
                DB::table('pusher_path')
                    ->insert([
                        "path" => $pusherPath,
                        "email" => $user->getEmail()
                    ]);
            }



            Auth::login($finduser);

            // return redirect('dashboard');

            //return $user;

            ///provide token

            $token = md5(uniqid(rand(), true));






            return redirect('home');

       



        } else {

            $newUser = User::create([

                'name' => $user->name,

                'email' => $user->email,

                'google_id' => $user->id,

                'password' => encrypt('123456dummy')

            ]);

            $pusher_path = DB::table('pusher_path')
                ->where('email', $user->email)
                ->get();

            if (count($pusher_path) == 0) {
                $pusherPath = md5(uniqid(rand(), true));
                DB::table('pusher_path')
                    ->insert([
                        "path" => $pusherPath,
                        "email" => $user->email
                    ]);
            }


            Auth::login($newUser);

            // return $user;

            $token = md5(uniqid(rand(), true));

           


            //return view('welcome',['token'=>$token]);


            return redirect('home');
            // return view()

        }
    } catch (Exception $e) {



        dd($e);
    }
});

Route::get('user', function () {
    $users = DB::table('users')
        ->get();

    return $users;
});

Route::post('social/{provider}', [AuthController::class, 'social']);


Route::get('login',[UploadBookController::class,'testLogin']);

