<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    // Landing page (/).
    public function landing()
    {
        return view('pages.landing');
    }

    // About page (/about).
    public function about()
    {
        return view('pages.about');
    }
}
