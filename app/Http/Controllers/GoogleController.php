<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Lấy thông tin user từ Google
            $socialUser = Socialite::driver('google')->stateless()->user();


            $provider = 'GOOGLE'; // Xác định provider là google


            // Tìm user đã tồn tại theo provider + provider_id
            $user = User::where('provider', $provider)
                        ->where('provider_id', $socialUser->getId())
                        ->where('user_email', $socialUser->getEmail() )
                        ->first();

            // Kiểm tra có lấy được email không
            //dd($socialUser->getEmail());
            //dd($user);

            if ($user==null) {
                // Nếu chưa có user, tạo mới
                $user = User::create([
                    'user_name'        => $socialUser->getName(),
                    'user_email'       => $socialUser->getEmail(),
                    'role_id'   =>3,
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'user_avatar'      => "default-google.png",
                    'user_password'    => bcrypt('defaultpassword') // có thể random nếu không dùng
                ]);
            }

            // Đăng nhập user
            Auth::login($user);
            session()->regenerate();
            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Đăng nhập Google thất bại!');
        }
    }
}