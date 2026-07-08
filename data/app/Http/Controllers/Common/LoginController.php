<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show Login Page
     */
    public function admin_login()
    {
        Session::forget('mail_success');


        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('common.login.login');
    }

    /**
     * Login Check
     */
    public function admin_login_check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|email',
            'password'  => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        try {

            $remember = $request->boolean('remember_me');

            $credentials = [
                'email'    => $request->user_name,
                'password' => $request->password,
                'status'   => 'Active',
            ];

            if (!Auth::attempt($credentials, $remember)) {
                return response()->json([
                    'status' => 'error',
                    'msg'    => 'Invalid email or password.'
                ]);
            }

            $request->session()->regenerate();

            $user = Auth::user();

            // Ensure user has a role
            if ($user->getRoleNames()->isEmpty()) {
                Auth::logout();

                return response()->json([
                    'status' => 'error',
                    'msg'    => 'No role has been assigned to your account.'
                ]);
            }

            // Determine redirect URL
            $redirect = match (true) {
                $user->hasRole('SuperAdmin') => route('superadmin.dashboard'),
                $user->hasRole('Admin')      => route('admin.dashboard'),
                $user->hasRole('Member')     => route('member.dashboard'),
                default                      => null,
            };

            if (!$redirect) {
                Auth::logout();

                return response()->json([
                    'status' => 'error',
                    'msg'    => 'You are not authorized to access this application.'
                ]);
            }

            return response()->json([
                'status'   => 'success',
                'msg'      => 'Login successful.',
                'role'     => $user->getRoleNames()->first(),
                'redirect' => $redirect,
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'status' => 'error',
                'msg'    => 'Something went wrong. Please try again.'
            ]);
        }
    }

    /**
     * Forgot Password Page
     */
    public function admin_forgot_password()
    {
        return view('common.forgot_password.forgot_password');
    }

    /**
     * Redirect user based on role
     */
    private function redirectByRole($user)
    {
        return match (true) {
            $user->hasRole('SuperAdmin') => redirect()->route('superadmin.dashboard'),
            $user->hasRole('Admin')      => redirect()->route('admin.dashboard'),
            $user->hasRole('Member')     => redirect()->route('member.dashboard'),
            default                      => abort(403, 'Unauthorized'),
        };
    }
}