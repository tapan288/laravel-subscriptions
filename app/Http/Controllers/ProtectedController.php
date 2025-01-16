<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ProtectedController extends Controller
{
    public function index()
    {
        return Inertia::render('Protected');
    }
}
