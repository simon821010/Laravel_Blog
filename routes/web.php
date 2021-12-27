<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;


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

Route::get('/phpinfo', function() {
    return phpinfo();
});

Route::prefix('user')->group(function () {
    //使用者驗證
    Route::prefix('auth')->group(function () {
        //使用者註冊畫面
        Route::get('/sign-up', [UserAuthController::class, 'signUpPage']);
        //處理註冊資料
        Route::post('/sign-up', [UserAuthController::class, 'signUpProcess']);
        //使用者登入畫面
        Route::get('/sign-in', [UserAuthController::class, 'signInPage']);
        //處理登入資料
        Route::post('/sign-in', [UserAuthController::class, 'signInProcess']);
        //處理登出資料
        Route::get('/sign-out', [UserAuthController::class, 'signOut']);
    });
});

Route::middleware('auth.admin')->group(function (){
    Route::prefix('admin')->group(function () {
        //自我介紹相關
        Route::prefix('user')->group(function () {
            //自我介紹頁面
            Route::get('/', [AdminController::class, 'editUserPage']);
            //處理自我介紹資料
            Route::post('/', [AdminController::class, 'editUserProcess']);
        });

        //心情隨筆相關
        Route::prefix('mind')->group(function () {
            //心情隨筆列表頁面
            Route::get('/', [AdminController::class, 'mindListPage']);
            //新增心情隨筆資料
            Route::get('/add', [AdminController::class, 'addMindPage']);
            //處理心情隨筆資料
            Route::post('/edit', [AdminController::class, 'editMindProcess']);
            //單一資料
            Route::prefix('{mind_id}')->group(function () {
                //編輯心情隨筆資料
                Route::get('/edit', [AdminController::class, 'editMindPage']);
                //刪除心情隨筆資料
                Route::get('/delete', [AdminController::class, 'deleteMindProcess']);
            });
        });
    });
});

Route::prefix('/')->group(function () {
    //首頁
    Route::get('/', [HomeController::class, 'indexPage']);
    //單一使用者資料
    Route::prefix('{user_id}')->group(function () {
        //自我介紹
        Route::get('/user', [HomeController::class, 'userPage']);
        //心情隨筆
        Route::get('/mind', [HomeController::class, 'mindPage']);
        //留言板
        Route::get('/board', [HomeController::class, 'boardPage']);
        //編輯留言板
        Route::post('/board', [HomeController::class, 'boardProcess']);
    });
});
?>
