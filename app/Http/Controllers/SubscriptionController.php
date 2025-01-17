<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return Inertia::render('Subscription/Index');
    }

    public function portal(Request $request)
    {
        return $request->user()
            ->redirectToBillingPortal(route('subscription'));
    }
}
