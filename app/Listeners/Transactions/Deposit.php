<?php

namespace API\Listeners\Transactions;

use API\Events\Transactions\Deposit as DepositEvent;
use API\Models\Transactions\Payment;
use API\Models\Transactions\Bonus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;

class Deposit
{
    /**
     * Handle the event.
     *
     * @param  Deposit  $event
     * @return void
     */
    public function handle(DepositEvent $event)
    {
        $deposit = $event->deposit;
        $customer = $deposit->customer;
        $count_deposits = $customer->payments->where('type', Payment::DEPOSIT)->count();
        $bonus_deposit = Config::get('app.bonus_deposit', 3);
        if ($count_deposits > 0 && !($count_deposits % $bonus_deposit)) {
            $bonus = new Bonus;
            $bonus->amount = intval(($deposit->amount * $customer->bonus_percent) / 100);
            $bonus->customer_id = $customer->id;
            $bonus->payment_id = $deposit->id;
            $bonus->type = Bonus::INCOME;
            $bonus->save();
        }
    }
}
