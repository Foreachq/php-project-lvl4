<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    private const FIVE_YEARS_IN_MIN = 5 * 365 * 24 * 60;

    public function index(): Renderable
    {
        return view('home');
    }

    public function changeLang($lang): RedirectResponse
    {
        App::setLocale($lang);
        Cookie::queue('lang', $lang, self::FIVE_YEARS_IN_MIN);

        return redirect()->back();
    }
}
