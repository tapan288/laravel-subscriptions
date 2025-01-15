<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = collect(config('subscriptions.plans'));

        return Inertia::render('Plans', [
            'monthly' => $plans->get('monthly'),
            'yearly' => $plans->get('yearly'),
        ]);
    }
}
