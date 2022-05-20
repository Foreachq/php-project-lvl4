<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index(): Renderable
    {
        return view('home');
    }

    public function changeLang($lang): RedirectResponse
    {
        App::setLocale($lang);
        session()->put('lang', $lang);

        return redirect()->back();
    }
}
