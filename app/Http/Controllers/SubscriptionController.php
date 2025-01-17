<?php

namespace App\Http\Controllers;

use App\Subscription\StripeSubscriptionDecorator;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $plan = $request->user()->subscribed() ? new StripeSubscriptionDecorator($request->user()->subscription()->asStripeSubscription()) : null;
        // dd($request->user()->subscription()->asStripeSubscription());
        return Inertia::render('Subscription/Index', [
            'plan' => [
                'title' => $plan->title(),
                'currency' => $plan->currency(),
            ],
        ]);
    }

    public function portal(Request $request)
    {
        return $request->user()
            ->redirectToBillingPortal(route('subscription'));
    }
}
