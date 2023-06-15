<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => [$this->username() => 'required', 'email:rfc,dns', 'string', 'min:4',],
            'password' => ['required', 'string', 'min:4'],
        ]);
    }

    protected function attemptLogin(Request $request): bool
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    protected function authenticated(Request $request, $user): RedirectResponse
    {
        return redirect()->intended($this->redirectPath())
            ->with('login_success', 'Selamat datang! Anda berhasil login.');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    protected function redirectToAdmin()
    {
        return '/admin';
    }

    protected function redirectToUser()
    {
        return '/';
    }
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        if (Auth::check() && Auth::user()->role == '1') {
            return '/admin';
        } else if (Auth::check() && Auth::user()->role == '2') {
            return '/admin';
        } else {
            return '/';
        }
    }

}
