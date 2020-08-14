<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPassswordRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Mail\AdminResetPassword;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        $loginData = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($loginData, $remember_me)) {
            return redirect()->route('admin.welcome');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.get_login');
    }

    public function get_forgot_password()
    {
        return redirect()->route('admin.get_login');
    }

    public function forgot_password(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (isset($user)) {
            // Create token
            $token = app('auth.password.broker')->createToken($user);
            // Store token in DB
            $data = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            // Send email to user
            return new AdminResetPassword(['user' => $user, 'token' => $token]);
        }
    }

    public function get_reset_password(string $token)
    {
        $check_token = DB::table('password_resets')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))
            ->first();

        if (isset($check_token)) {
            return view('auth.passwords.reset_password', compact('check_token'));
        } else {
            return redirect()->route('admin.get_login');
        }
    }

    public function reset_password(ResetPasswordRequest $request, string $token)
    {
        $check_token = DB::table('password_resets')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))
            ->first();

        if (isset($check_token)) {
            $user = User::where('email', $check_token->email)->first();
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            // Remove old token data
            DB::table('password_resets')->where('email', $check_token->email)->delete();
            Auth::attempt(['email' => $user->email, 'password' => $request->password], true);
            return redirect(RouteServiceProvider::ADMIN);
        } else {
            return redirect()->route('admin.get_login');
        }
    }
}
