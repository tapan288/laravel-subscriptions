<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        // dd(auth()->user()->subscribed());
        // dd(auth()->user()->subscription()->canceled());

        return Inertia::render('Home');
    }
}
