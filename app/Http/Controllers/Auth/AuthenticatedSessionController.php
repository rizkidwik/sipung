<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $config = Configuration::get();
        $data = [];
        foreach ($config as $conf) {
            $code = str_replace('.', '_', $conf->config_code);
            $data[$code] = $conf->config_value;
        }
        return view('backend.auth.login', compact('data'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $logo = Configuration::where('config_code', 'app.logo')->first();
        $name = Configuration::where('config_code', 'app.name')->first();
        if($logo && $name){
            Session::put('logo', asset("uploads/" . $logo->config_value));
            Session::put('app_name', asset("uploads/" . $name->config_value));
        }
        $request->session()->regenerate();

        addLogUser('Login');
        
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        addLogUser('Logout');
        Auth::guard('web')->logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
