<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function testUser(): RedirectResponse
    {
        $testUser = User::where('email', 'testUser@email.com')->first();
        if ($testUser === null) {
            $testUser = User::factory()
                ->state([
                    'name' => 'Test User',
                    'email' => 'testUser@email.com',
                ])
                ->create();
        }

        Auth::login($testUser);

        return redirect()->route('tasks.index');
    }
}
