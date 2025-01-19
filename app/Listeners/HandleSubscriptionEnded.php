<?php

namespace App\Listeners;

use App\Notifications\SubscriptionEnded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;

class HandleSubscriptionEnded
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] != 'customer.subscription.deleted') {
            return;
        }

        $user = Cashier::findBillable($event->payload['data']['object']['customer']);

        $user->notify(new SubscriptionEnded());
    }
}
