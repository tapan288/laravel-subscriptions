<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Subscription\StripeSubscriptionDecorator;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $plan = $request->user()->subscribed() ?
            new StripeSubscriptionDecorator(
                $request->user()
                    ->subscription()->asStripeSubscription(),
            ) : null;

        $upcoming = $request->user()->upcomingInvoice();

        return Inertia::render('Subscription/Index', [
            'plan' => [
                'title' => $plan->title(),
                'currency' => $plan->currency(),
            ],
            'upcoming' => [
                'date' => $upcoming->date()->toDateString(),
                'human_readable' => $upcoming->date()->diffForHumans(),
                'total' => $upcoming->total(),
            ],
        ]);
    }

    public function portal(Request $request)
    {
        return $request->user()
            ->redirectToBillingPortal(route('subscription'));
    }
}
