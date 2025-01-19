<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceResource;
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
            'subscription' => [
                'ends_at' => $request->user()->subscription()
                    ?->ends_at?->toDateString(),
                'diff_for_humans' => $request->user()->subscription()
                    ?->ends_at?->diffForHumans(),
            ],
            'upcoming' => [
                'date' => $upcoming->date()->toDateString(),
                'human_readable' => $upcoming->date()->diffForHumans(),
                'total' => $upcoming->total(),
            ],
            'invoices' => InvoiceResource::collection(
                $request->user()->invoices(),
            ),
        ]);
    }

    public function portal(Request $request)
    {
        return $request->user()
            ->redirectToBillingPortal(route('subscription'));
    }

    public function resume(Request $request)
    {
        $request->user()->subscription()->resume();

        return back();
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription()->cancel();

        return back();
    }

    public function invoice(Request $request)
    {
        return $request->user()
            ->downloadInvoice($request->invoice);
    }
}
