<?php

namespace API\Listeners;

use API\Events\CustomerCreated as CustomerCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerCreated
{
    /**
     * Handle the event.
     *
     * @param  CustomerCreated  $event
     * @return void
     */
    public function handle(CustomerCreatedEvent $event)
    {
        $customer = $event->customer;
        $customer->bonus_percent = rand(5, 20);
        $customer->save();
    }
}
