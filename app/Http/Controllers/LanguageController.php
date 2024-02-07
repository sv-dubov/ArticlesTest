<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($lang_code)
    {
        App::setLocale($lang_code);
        session()->put('lang_code', $lang_code);

        return redirect()->back();
    }
}
