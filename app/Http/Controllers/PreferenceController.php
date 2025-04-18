<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function setLanguage(Request $request)
    {
        $lang = $request->input('lang', 'es');
        return back()->withCookie(cookie('site_language', $lang, 60*24*30));
    }

    public function setTheme(Request $request)
    {
        $theme = $request->input('theme', 'light');
        return back()->withCookie(cookie('site_theme', $theme, 60*24*30));
    }

    public function addVisitedProduct(Request $request, $productId)
    {
        $visited = json_decode($request->cookie('visited_products', '[]'), true);
        $visited[] = $productId;
        $visited = array_unique($visited);
        return back()->withCookie(cookie('visited_products', json_encode($visited), 60*24*30));
    }
}
