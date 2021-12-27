<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module\ShareData;
use Validator;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Entity\User;

class UserAuthController extends Controller
{
    public $page = "";
    //使用者註冊畫面
    public function signUpPage()
    {
        $name = 'sign_up';
        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
        ];
        return view('user.sign-up', $binding);
    }

    public function signUpProcess()
    {
        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //暱稱
            'name' => [
                'required',
                'max:50',
            ],
            //帳號(E-mail)
            'account' => [
                'required',
                'max:50',
                'email',
            ],
            //密碼
            'password' => [
                'required',
                'min:5',
            ],
            //密碼驗證
            'password_confirm' => [
                'required',
                'same:password',
                'min:5'
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            //資料驗證錯誤
            return redirect('/user/auth/sign-up')
            ->withErrors($validator)
            ->withInput();
        }

        $input['password'] = Hash::make($input['password']);
        
        //Log::notice(print_r($input, true));

        //啟用紀錄SQL語法
        DB::enableQueryLog();

        //新增使用者資料
        User::create($input);

        //取得目前使用過的SQL語法
        Log::notice(print_r(DB::getQueryLog(), true));

        //重新導向到登入頁
        return redirect('/user/auth/sign-in');
    }

    //使用者登入畫面
    public function signInPage()
    {
        $name = 'sign_in';
        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
        ];
        return view('user.sign-in', $binding);
    }

    //處理登入資料
    public function signInProcess()
    {
        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //帳號(E-mail)
            'account' => [
                'required',
                'max:50',
                'email',
            ],
            //密碼
            'password' => [
                'required',
                'min:5',
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            //資料驗證錯誤
            return redirect('/user/auth/sign-up')
                ->withErrors($validator)
                ->withInput();
        }

        //取得使用者資料
        $User = User::where('account', $input['account'])->first();

        if(!$User)
        {
            //帳號錯誤回傳錯誤訊息
            $error_message = [
                'msg' => [
                    '帳號輸入錯誤',
                ],
            ];

            return redirect('/user/auth/sign-in')
                ->withErrors($error_message)
                ->withInput();
        }

        //檢查密碼是否正確
        $is_password_correct = Hash::check($input['password'], $User->password);

        if(!$is_password_correct)
        {
            //密碼錯誤回傳錯誤訊息
            $error_message = [
                'msg' => [
                    '密碼輸入錯誤',
                ],
            ];

            return redirect('/user/auth/sign-in')
                ->withErrors($error_message)
                ->withInput();
        }

        //session紀錄會員編號
        session()->put('user_id', $User->id);

        //重新導向到原先使用者造訪頁面，沒有嘗試造訪頁則重新導向回自我介紹頁
        return redirect()->intended('/admin/user');
    }

    //登出
    public function signOut()
    {
        //清除Session
        session()->forget('user_id');

        //重新導向回首頁
        return redirect('/');
    }
}
