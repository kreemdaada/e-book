<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $navbar = view('includes.navbar');

        // Die Navbar wird als Variable an die About-Seite übergeben
        return view('about.index', compact('navbar'));
    }
}
